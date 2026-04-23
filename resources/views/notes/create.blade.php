@extends('layouts.app')

@section('title', 'Buat Catatan - ' . config('app.name', 'Laravel'))

@section('styles')
    <style>
        .ck-editor__editable_inline {
            min-height: 280px;
            background-color: #FCFBF8 !important;
            color: #1b1b18 !important;
            border-radius: 0 0 24px 24px !important;
            padding: 0 1.5rem !important;
        }
        .ck-toolbar {
            background-color: #F7F5F2 !important;
            border-radius: 24px 24px 0 0 !important;
            border-color: #e3e3e0 !important;
        }
        .dark .ck-editor__editable_inline {
            background-color: #121212 !important;
            color: #F7F7F5 !important;
            border-color: #3E3E3A !important;
        }
        .dark .ck-toolbar {
            background-color: #1a1a1a !important;
            border-color: #3E3E3A !important;
        }
        .dark .ck.ck-toolbar__separator {
            background-color: #3E3E3A !important;
        }
        .dark .ck.ck-button {
            color: #F7F7F5 !important;
        }
        .dark .ck.ck-button:hover {
            background-color: #2a2a2a !important;
        }
        .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {
            border-color: #e3e3e0 !important;
        }
        .ck.ck-editor__main>.ck-editor__editable.ck-focused {
            border-color: #f53003 !important;
            box-shadow: 0 0 0 2px #f0dad8 !important;
        }
        .dark .ck.ck-editor__main>.ck-editor__editable.ck-focused {
            border-color: #f53003 !important;
            box-shadow: 0 0 0 2px rgba(245, 48, 3, 0.2) !important;
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
                        <label for="title" class="mb-2 block text-sm font-medium text-[#1b1b18] dark:text-white">Judul Catatan / Blog</label>
                        <input id="title" name="title" type="text" value="{{ old('title') }}" placeholder="Masukkan judul..." class="w-full rounded-[18px] border border-[#e3e3e0] bg-white px-4 py-3 text-sm text-[#1b1b18] shadow-sm outline-none transition focus:border-[#f53003] focus:ring-2 focus:ring-[#f0dad8] dark:border-[#3E3E3A] dark:bg-[#101010] dark:text-[#F7F7F5] dark:focus:border-[#f53003]" required />
                    </div>

                    <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-3">
                        <div>
                            <label for="type" class="mb-2 block text-sm font-medium text-[#1b1b18] dark:text-white">Tipe</label>
                            <select id="type" name="type" class="w-full rounded-[18px] border border-[#e3e3e0] bg-white px-4 py-3 text-sm text-[#1b1b18] shadow-sm outline-none transition focus:border-[#f53003] focus:ring-2 focus:ring-[#f0dad8] dark:border-[#3E3E3A] dark:bg-[#101010] dark:text-[#F7F7F5] dark:focus:border-[#f53003]">
                                <option value="post" {{ old('type') == 'post' ? 'selected' : '' }}>Post (Blog)</option>
                                <option value="page" {{ old('type') == 'page' ? 'selected' : '' }}>Page (Statis)</option>
                            </select>
                        </div>
                        <div>
                            <label for="category_id" class="mb-2 block text-sm font-medium text-[#1b1b18] dark:text-white">Kategori</label>
                            <select id="category_id" name="category_id" class="w-full rounded-[18px] border border-[#e3e3e0] bg-white px-4 py-3 text-sm text-[#1b1b18] shadow-sm outline-none transition focus:border-[#f53003] focus:ring-2 focus:ring-[#f0dad8] dark:border-[#3E3E3A] dark:bg-[#101010] dark:text-[#F7F7F5] dark:focus:border-[#f53003]">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="status" class="mb-2 block text-sm font-medium text-[#1b1b18] dark:text-white">Status</label>
                            <select id="status" name="status" class="w-full rounded-[18px] border border-[#e3e3e0] bg-white px-4 py-3 text-sm text-[#1b1b18] shadow-sm outline-none transition focus:border-[#f53003] focus:ring-2 focus:ring-[#f0dad8] dark:border-[#3E3E3A] dark:bg-[#101010] dark:text-[#F7F7F5] dark:focus:border-[#f53003]">
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="editor" class="mb-2 block text-sm font-medium text-[#1b1b18] dark:text-white">Isi Konten</label>
                        <textarea id="editor" name="note" class="hidden">{{ old('note') }}</textarea>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <script>
        class MyUploadAdapter {
            constructor(loader) {
                this.loader = loader;
            }

            upload() {
                return this.loader.file
                    .then(file => new Promise((resolve, reject) => {
                        this._initRequest();
                        this._initListeners(resolve, reject, file);
                        this._sendRequest(file);
                    }));
            }

            abort() {
                if (this.xhr) {
                    this.xhr.abort();
                }
            }

            _initRequest() {
                const xhr = this.xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route("ckeditor.upload") }}', true);
                xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}');
                xhr.responseType = 'json';
            }

            _initListeners(resolve, reject, file) {
                const xhr = this.xhr;
                const loader = this.loader;
                const genericErrorText = `Couldn't upload file: ${file.name}.`;

                xhr.addEventListener('error', () => reject(genericErrorText));
                xhr.addEventListener('abort', () => reject());
                xhr.addEventListener('load', () => {
                    const response = xhr.response;
                    if (!response || response.error) {
                        return reject(response && response.error ? response.error : genericErrorText);
                    }
                    resolve({
                        default: response.url
                    });
                });

                if (xhr.upload) {
                    xhr.upload.addEventListener('progress', evt => {
                        if (evt.lengthComputable) {
                            loader.uploadTotal = evt.total;
                            loader.uploaded = evt.loaded;
                        }
                    });
                }
            }

            _sendRequest(file) {
                const data = new FormData();
                data.append('upload', file);
                this.xhr.send(data);
            }
        }

        function MyCustomUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new MyUploadAdapter(loader);
            };
        }

        ClassicEditor
            .create(document.querySelector('#editor'), {
                extraPlugins: [MyCustomUploadAdapterPlugin],
                toolbar: {
                    items: [
                        'heading', '|',
                        'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                        'outdent', 'indent', '|',
                        'imageUpload', 'blockQuote', 'insertTable', 'mediaEmbed', 'undo', 'redo'
                    ]
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
