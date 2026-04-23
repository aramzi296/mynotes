@extends('layouts.app')

@section('title', config('app.name', 'Laravel') . ' - Detail Catatan')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github-dark.min.css">
    <style>
        .note-content img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            margin: 0.5rem;
            display: inline-block !important;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }
        .note-content .image-side {
            float: right;
            margin-left: 1.5rem;
            max-width: 50%;
        }
        .note-content .image-inline {
            display: inline-block;
            margin: 0 0.5rem;
            vertical-align: middle;
        }
        .note-content figure.image {
            margin: 1.5rem 0;
            display: table;
            clear: both;
        }
        .note-content figure.image img {
            margin: 0;
        }
        .note-content figure.image figcaption {
            display: table-caption;
            caption-side: bottom;
            background-color: #f8f9fa;
            padding: 0.5rem;
            font-size: 0.8rem;
            color: #6c757d;
            text-align: center;
        }
        .note-content ul {
            list-style-type: disc;
            padding-left: 1.5rem;
            margin-bottom: 1rem;
        }
        .note-content ol {
            list-style-type: decimal;
            padding-left: 1.5rem;
            margin-bottom: 1rem;
        }
        .note-content h2, .note-content h3, .note-content h4 {
            font-weight: 600;
            margin-top: 1.5rem;
            margin-bottom: 0.5rem;
        }
        .note-content blockquote {
            border-left: 4px solid #f53003;
            padding-left: 1rem;
            font-style: italic;
            color: #6f6d69;
            margin: 1rem 0;
        }
        .note-content pre {
            background-color: #1a1a1a;
            border-radius: 12px;
            padding: 1rem;
            overflow-x: auto;
            margin: 1.5rem 0;
        }
        .note-content code {
            font-family: 'Fira Code', 'Courier New', Courier, monospace;
            font-size: 0.9em;
            background-color: #f0f0f0;
            padding: 0.2rem 0.4rem;
            border-radius: 4px;
            color: #d23131;
        }
        .dark .note-content code {
            background-color: #1a1a1a;
            color: #ff6b35;
        }
        .note-content pre code {
            background-color: transparent;
            padding: 0;
            color: inherit;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
@endsection

@section('content')
            <div class="mb-6">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 rounded-2xl border border-[#e3e3e0] px-4 py-2 text-sm font-medium text-[#1b1b18] transition hover:bg-[#F4F2F0] dark:border-[#3E3E3A] dark:text-[#F7F7F5] dark:hover:bg-[#141414]">
                    ← Kembali
                </a>
            </div>

            @if (session('status'))
                <div class="mb-6 rounded-[20px] border border-[#d7e9d6] bg-[#f0fbf2] p-4 text-sm text-[#1f5f2f] dark:border-[#21492e] dark:bg-[#132314] dark:text-[#b7e3b2]">
                    {{ session('status') }}
                </div>
            @endif

            <div class="rounded-[32px] border border-[#E8E6E1] bg-white p-8 shadow-sm dark:border-[#3E3E3A] dark:bg-[#111111]">
                <!-- Header -->
                <div class="mb-6">
                    <div class="flex items-center gap-3 mb-2">
                        @if($note->category)
                            <span class="rounded-full bg-[#f0f0f0] px-3 py-1 text-xs font-semibold text-[#1b1b18] dark:bg-[#1a1a1a] dark:text-[#F7F7F5]">
                                📁 {{ $note->category->name }}
                            </span>
                        @endif
                        <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $note->status === 'published' ? 'bg-[#f0fbf2] text-[#1f5f2f]' : 'bg-[#fffbeb] text-[#92400e]' }}">
                            {{ ucfirst($note->status) }}
                        </span>
                    </div>
                    <h1 class="text-4xl font-bold text-[#111111] dark:text-white leading-tight">
                        {{ $note->title ?? 'Tanpa Judul' }}
                    </h1>
                </div>

                <!-- Content -->
                <div class="mb-6 note-content prose prose-sm dark:prose-invert max-w-none text-[#1b1b18] dark:text-[#F7F7F5]">
                    {!! $note->content !!}
                </div>

                <!-- Tags -->
                @if ($note->tags)
                    <div class="mb-6 flex flex-wrap gap-2">
                        @foreach (explode(',', $note->tags) as $tag)
                            <span class="inline-block rounded-full bg-[#f0f0f0] px-3 py-1 text-xs font-medium text-[#6f6d69] dark:bg-[#1a1a1a] dark:text-[#A1A09A]">
                                {{ trim($tag) }}
                            </span>
                        @endforeach
                    </div>
                @endif

                <!-- Attachment Image Preview -->
                @if ($note->attachment_path)
                    @php
                        $fileExt = strtolower(pathinfo($note->attachment_path, PATHINFO_EXTENSION));
                        $isImage = in_array($fileExt, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                    @endphp

                    @if ($isImage)
                        <div class="mb-6">
                            <p class="mb-3 text-sm font-medium text-[#1b1b18] dark:text-white">Gambar</p>
                            <a href="{{ asset('storage/' . $note->attachment_path) }}" target="_blank" class="block rounded-[24px] border border-[#e3e3e0] overflow-hidden dark:border-[#3E3E3A] hover:shadow-lg transition">
                                <img src="{{ asset('storage/' . $note->attachment_path) }}" alt="Note attachment" class="max-h-96 w-full object-cover">
                            </a>
                        </div>
                    @endif
                @endif

                <!-- Metadata -->
                <div class="border-t border-[#e3e3e0] pt-6 dark:border-[#3E3E3A]">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div class="text-sm text-[#9b998f] dark:text-[#706f6c]">
                            Dibuat pada {{ $note->created_at->format('d M Y H:i') }}
                            @if ($note->created_at->notEqualTo($note->updated_at))
                                · Diubah pada {{ $note->updated_at->format('d M Y H:i') }}
                            @endif
                        </div>
                        <div class="flex flex-wrap gap-2">
                            @if ($note->attachment_path)
                                <a href="{{ asset('storage/' . $note->attachment_path) }}" target="_blank" class="inline-flex items-center gap-2 rounded-2xl bg-[#f0f0f0] px-4 py-2 text-sm font-medium text-[#1b1b18] transition hover:bg-[#e0e0e0] dark:bg-[#1a1a1a] dark:text-[#F7F7F5] dark:hover:bg-[#242424]">
                                    📎 Download File
                                </a>
                            @endif
                            <a href="{{ route('notes.edit', $note) }}" class="inline-flex items-center gap-2 rounded-2xl bg-[#f53003] px-4 py-2 text-sm font-medium text-white transition hover:bg-[#d72a02]">
                                ✏️ Edit
                            </a>
                            <form id="delete-form-{{ $note->id }}" action="{{ route('notes.destroy', $note) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus catatan ini? Data dan file akan dihapus secara permanen.')" class="inline-flex items-center gap-2 rounded-2xl bg-[#f5f5f5] px-4 py-2 text-sm font-medium text-[#f53003] transition hover:bg-[#ffe8e1] dark:bg-[#1a1a1a] dark:text-[#ff6b4d] dark:hover:bg-[#2a1a16]">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
@endsection
