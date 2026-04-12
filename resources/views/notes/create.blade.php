@extends('layouts.app')

@section('title', 'Buat Catatan - ' . config('app.name', 'Laravel'))

@section('styles')
    <link rel="stylesheet" href="https://cdn.quilljs.com/1.3.7/quill.snow.css">
    <style>
        #quill-editor.ql-container {
            font-size: 1rem;
            font-family: inherit;
        }
        #quill-editor.ql-editor {
            background-color: #FCFBF8;
            color: #1b1b18;
            min-height: 280px;
            padding: 1rem;
        }
        .ql-toolbar.ql-snow {
            background-color: #F7F5F2 !important;
            border: 1px solid #e3e3e0;
            border-radius: 6px 6px 0 0;
            color: #1b1b18;
        }
        .ql-toolbar.ql-snow .ql-stroke {
            stroke: #1b1b18 !important;
        }
        .ql-toolbar.ql-snow .ql-fill {
            fill: #1b1b18 !important;
        }
        .ql-toolbar.ql-snow .ql-picker-label {
            color: #1b1b18 !important;
        }
        .ql-toolbar.ql-snow button:hover,
        .ql-toolbar.ql-snow button.ql-active,
        .ql-toolbar.ql-snow button:focus,
        .ql-toolbar.ql-snow button:active,
        .ql-toolbar.ql-snow .ql-picker-label:hover,
        .ql-toolbar.ql-snow .ql-picker-item:hover,
        .ql-toolbar.ql-snow .ql-picker-item.ql-selected {
            color: #f53003 !important;
        }
        .ql-toolbar.ql-snow button:hover .ql-stroke,
        .ql-toolbar.ql-snow button.ql-active .ql-stroke,
        .ql-toolbar.ql-snow .ql-picker-label:hover .ql-stroke,
        .ql-toolbar.ql-snow .ql-picker-item:hover .ql-stroke,
        .ql-toolbar.ql-snow .ql-picker-item.ql-selected .ql-stroke {
            stroke: #f53003 !important;
        }
        .ql-toolbar.ql-snow button:hover .ql-fill,
        .ql-toolbar.ql-snow button.ql-active .ql-fill,
        .ql-toolbar.ql-snow .ql-picker-label:hover .ql-fill,
        .ql-toolbar.ql-snow .ql-picker-item:hover .ql-fill,
        .ql-toolbar.ql-snow .ql-picker-item.ql-selected .ql-fill {
            fill: #f53003 !important;
        }
        .dark #quill-editor.ql-editor {
            background-color: #121212;
            color: #F7F7F5;
        }
        .dark .ql-toolbar.ql-snow {
            background-color: #1a1a1a !important;
            border-color: #3E3E3A;
        }
        .dark .ql-toolbar.ql-snow .ql-stroke {
            stroke: #F7F7F5 !important;
        }
        .dark .ql-toolbar.ql-snow .ql-fill {
            fill: #F7F7F5 !important;
        }
        .dark .ql-toolbar.ql-snow .ql-picker-label {
            color: #F7F7F5 !important;
        }
    </style>
@endsection

@section('content')
            <div class="mb-8 rounded-[32px] border border-[#E8E6E1] bg-white p-8 shadow-sm dark:border-[#3E3E3A] dark:bg-[#111111]">
                <div class="mb-6 flex items-center justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-semibold text-[#111111] dark:text-white">Buat Catatan</h1>
                        <p class="mt-2 text-sm text-[#6f6d69] dark:text-[#A1A09A]">Isi catatanmu dengan editor rich text, lalu tambahkan tag dan unggah file.</p>
                    </div>
                </div>

                <form id="note-form" action="{{ route('notes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if (session('status'))
                        <div class="mb-6 rounded-[20px] border border-[#d7e9d6] bg-[#f0fbf2] p-4 text-sm text-[#1f5f2f] dark:border-[#21492e] dark:bg-[#132314] dark:text-[#b7e3b2]">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="mb-6">
                        <label for="quill-editor" class="mb-2 block text-sm font-medium text-[#1b1b18] dark:text-white">Catatan</label>
                        <input id="note-content" type="hidden" name="note" value="{{ old('note') }}" />
                        <div id="quill-editor" class="min-h-[280px] rounded-[24px] border border-[#e3e3e0] bg-[#FCFBF8] p-4 text-sm leading-7 text-[#1b1b18] shadow-sm outline-none transition dark:border-[#3E3E3A] dark:bg-[#121212] dark:text-[#F7F7F5]">{!! old('note') !!}</div>
                    </div>

                    <div class="mb-6">
                        <label for="tags" class="mb-2 block text-sm font-medium text-[#1b1b18] dark:text-white">Tags</label>
                        <input id="tags" name="tags" type="text" placeholder="contoh: meeting, ide, tugas" class="w-full rounded-[18px] border border-[#e3e3e0] bg-white px-4 py-3 text-sm text-[#1b1b18] shadow-sm outline-none transition focus:border-[#d23131] focus:ring-2 focus:ring-[#f0dad8] dark:border-[#3E3E3A] dark:bg-[#101010] dark:text-[#F7F7F5] dark:focus:border-[#f53003]" />
                    </div>

                    <div class="mb-8">
                        <label for="attachment" class="mb-2 block text-sm font-medium text-[#1b1b18] dark:text-white">Upload</label>
                        <input id="attachment" name="attachment" type="file" accept="image/*,.pdf,.doc,.docx" class="w-full rounded-[18px] border border-[#e3e3e0] bg-white px-4 py-3 text-sm text-[#1b1b18] shadow-sm outline-none transition file:mr-4 file:rounded-full file:border-0 file:bg-[#f3f1ef] file:px-3 file:py-2 file:text-sm file:font-medium dark:border-[#3E3E3A] dark:bg-[#101010] dark:text-[#F7F7F5] dark:file:bg-[#1a1a1a]" />
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div class="text-sm text-[#6f6d69] dark:text-[#A1A09A]">Catatan belum tersimpan. Form ini belum mengirim data ke server.</div>
                        <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-[#f53003] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#d72a02]">Simpan Catatan</button>
                    </div>
                </form>
            </div>
@endsection

@section('scripts')
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const quill = new Quill('#quill-editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ header: [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike', 'code-block'],
                        [{ list: 'ordered' }, { list: 'bullet' }],
                        ['blockquote', 'link', 'image'],
                        [{ color: [] }, { background: [] }],
                        ['clean']
                    ]
                }
            });

            const form = document.querySelector('#note-form');
            const hiddenInput = document.querySelector('#note-content');

            form.addEventListener('submit', function () {
                hiddenInput.value = quill.root.innerHTML;
            });
        });
    </script>
@endsection
