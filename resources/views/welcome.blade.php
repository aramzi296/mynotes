@extends('layouts.app')

@section('content')
            <!-- Notes List -->
            <div class="space-y-4">
                @forelse ($notes as $note)
                    <a href="{{ route('notes.show', $note) }}" class="block rounded-[24px] border border-[#E8E6E1] bg-white p-6 shadow-sm transition hover:shadow-md dark:border-[#3E3E3A] dark:bg-[#111111] dark:hover:bg-[#1a1a1a]">
                        <div class="mb-3 flex items-start justify-between gap-4">
                            <div class="flex-1">
                                <div class="prose prose-sm dark:prose-invert max-w-none mb-2 line-clamp-3 text-[#1b1b18] dark:text-[#F7F7F5]">
                                    {!! $note->content !!}
                                </div>
                                @if ($note->tags)
                                    <div class="flex flex-wrap gap-2 mt-3">
                                        @foreach (explode(',', $note->tags) as $tag)
                                            <span class="inline-block rounded-full bg-[#f0f0f0] px-3 py-1 text-xs font-medium text-[#6f6d69] dark:bg-[#1a1a1a] dark:text-[#A1A09A]">
                                                {{ trim($tag) }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center justify-between gap-4 border-t border-[#e3e3e0] pt-3 text-xs text-[#9b998f] dark:border-[#3E3E3A] dark:text-[#706f6c]">
                            <span>{{ $note->created_at->format('d M Y H:i') }}</span>
                            @if ($note->attachment_path)
                                <span class="inline-flex items-center gap-1 text-[#f53003] dark:text-[#ff6b35]">
                                    📎 File
                                </span>
                            @endif
                        </div>
                    </a>
                @empty
                    <div class="rounded-[24px] border border-[#E8E6E1] bg-white p-8 text-center shadow-sm dark:border-[#3E3E3A] dark:bg-[#111111]">
                        <p class="text-[#706f6c] dark:text-[#A1A09A]">
                            {{ $searchQuery ? 'Tidak ada catatan yang sesuai dengan pencarian.' : 'Belum ada catatan. Mulai buat catatan baru!' }}
                        </p>
                        <a href="{{ route('notes.create') }}" class="mt-4 inline-block rounded-2xl bg-[#f53003] px-5 py-2 text-sm font-medium text-white transition hover:bg-[#d72a02]">
                            Buat Catatan
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($notes->hasPages())
                <div class="mt-8">
                    {{ $notes->links() }}
                </div>
            @endif
@endsection
