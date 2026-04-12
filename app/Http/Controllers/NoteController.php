<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class NoteController extends Controller
{
    public function show(Note $note): View
    {
        return view('notes.show', ['note' => $note]);
    }

    public function edit(Note $note): View
    {
        return view('notes.edit', ['note' => $note]);
    }

    public function update(Request $request, Note $note): RedirectResponse
    {
        $validated = $request->validate([
            'note' => ['required', 'string'],
            'tags' => ['nullable', 'string'],
            'attachment' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf,doc,docx', 'max:5120'],
        ]);

        $attachmentPath = $note->attachment_path;

        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        $note->update([
            'content' => $validated['note'],
            'tags' => $validated['tags'] ?? null,
            'attachment_path' => $attachmentPath,
        ]);

        return redirect()->route('notes.show', $note)->with('status', 'Catatan berhasil diperbarui.');
    }

    public function index(Request $request): View
    {
        $query = Note::query();

        if ($request->filled('q')) {
            $searchInput = trim($request->input('q'));
            $keywords = array_filter(explode(' ', $searchInput));

            // Each keyword must match either content or tags (AND logic across keywords)
            foreach ($keywords as $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('content', 'like', "%{$keyword}%")
                      ->orWhere('tags', 'like', "%{$keyword}%");
                });
            }
        }

        $notes = $query->latest()->paginate(10);

        return view('welcome', [
            'notes' => $notes,
            'searchQuery' => $request->input('q', ''),
        ]);
    }

    public function search(Request $request): View
    {
        return $this->index($request);
    }

    public function create(): View
    {
        return view('notes.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'note' => ['required', 'string'],
            'tags' => ['nullable', 'string'],
            'attachment' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf,doc,docx', 'max:5120'],
        ]);

        $attachmentPath = null;

        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        Note::create([
            'content' => $validated['note'],
            'tags' => $validated['tags'] ?? null,
            'attachment_path' => $attachmentPath,
        ]);

        return back()->with('status', 'Catatan berhasil disimpan.');
    }

    public function destroy(Note $note): RedirectResponse
    {
        if ($note->attachment_path) {
            Storage::disk('public')->delete($note->attachment_path);
        }

        $note->delete();

        return redirect()->route('home')->with('status', 'Catatan berhasil dihapus.');
    }
}
