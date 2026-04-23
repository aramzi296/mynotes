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
        $categories = \App\Models\Category::all();
        return view('notes.edit', compact('note', 'categories'));
    }

    public function update(Request $request, Note $note): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:post,page'],
            'note' => ['required', 'string'],
            'status' => ['required', 'in:draft,published'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'tags' => ['nullable', 'string'],
            'attachment' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf,doc,docx', 'max:5120'],
        ]);

        $attachmentPath = $note->attachment_path;

        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        $note->update([
            'title' => $validated['title'],
            'type' => $validated['type'],
            'slug' => $note->title !== $validated['title'] ? \Illuminate\Support\Str::slug($validated['title']) . '-' . uniqid() : $note->slug,
            'content' => $validated['note'],
            'status' => $validated['status'],
            'category_id' => $validated['category_id'],
            'tags' => $validated['tags'] ?? null,
            'attachment_path' => $attachmentPath,
        ]);

        return redirect()->route('notes.show', $note)->with('status', 'Catatan berhasil diperbarui.');
    }

    public function index(Request $request): View
    {
        $query = Note::where('type', 'post');

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

        $notes = $query->latest('updated_at')->paginate(10);

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
        $categories = \App\Models\Category::all();
        return view('notes.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:post,page'],
            'note' => ['required', 'string'],
            'status' => ['required', 'in:draft,published'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'tags' => ['nullable', 'string'],
            'attachment' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf,doc,docx', 'max:5120'],
        ]);

        $attachmentPath = null;

        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        \App\Models\Note::create([
            'title' => $validated['title'],
            'type' => $validated['type'],
            'slug' => \Illuminate\Support\Str::slug($validated['title']) . '-' . uniqid(),
            'content' => $validated['note'],
            'status' => $validated['status'],
            'category_id' => $validated['category_id'],
            'tags' => $validated['tags'] ?? null,
            'attachment_path' => $attachmentPath,
        ]);

        return back()->with('status', 'Catatan berhasil disimpan.');
    }

    public function destroy(Note $note): RedirectResponse
    {
        // 1. Hapus attachment file (jika ada)
        if ($note->attachment_path) {
            Storage::disk('public')->delete($note->attachment_path);
        }

        // 2. Hapus gambar-gambar yang ada di dalam konten (CKEditor)
        preg_match_all('/<img [^>]*src="([^"]+)"/', $note->content, $matches);
        
        if (!empty($matches[1])) {
            foreach ($matches[1] as $src) {
                // Ambil path relatif dari URL asset (misal: images/xxxx.jpg)
                $storagePath = str_replace(asset('storage/'), '', $src);
                Storage::disk('public')->delete($storagePath);
            }
        }

        $note->delete();

        return redirect()->route('home')->with('status', 'Catatan dan semua file terkait berhasil dihapus.');
    }

    public function upload(Request $request): \Illuminate\Http\JsonResponse
    {
        if ($request->hasFile('upload')) {
            $path = $request->file('upload')->store('images', 'public');

            return response()->json([
                'url' => asset('storage/' . $path),
            ]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
