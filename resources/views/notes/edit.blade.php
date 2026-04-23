@extends('layouts.app')

@section('title', 'Edit Catatan - ' . config('app.name', 'Laravel'))

@section('styles')
    <style>
        .tox-tinymce {
            border-radius: 12px !important;
            border: 1px solid #e3e3e0 !important;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }
        .dark .tox-tinymce {
            border-color: #3E3E3A !important;
        }
    </style>
@endsection

@section('content')
            <div class="mb-8 rounded-[32px] border border-[#E8E6E1] bg-white p-8 shadow-sm dark:border-[#3E3E3A] dark:bg-[#111111]">
                <div class="mb-6 flex items-center justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-semibold text-[#111111] dark:text-white">Edit Catatan</h1>
                        <p class="mt-2 text-sm text-[#6f6d69] dark:text-[#A1A09A]">Perbarui catatanmu dengan editor rich text, tambahkan tag atau unggah file baru.</p>
                    </div>
                </div>

                <form id="note-form" action="{{ route('notes.update', $note) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="title" class="mb-2 block text-sm font-medium text-[#1b1b18] dark:text-white">Judul Catatan / Blog</label>
                        <input id="title" name="title" type="text" value="{{ old('title', $note->title) }}" placeholder="Masukkan judul..." class="w-full rounded-[18px] border border-[#e3e3e0] bg-white px-4 py-3 text-sm text-[#1b1b18] shadow-sm outline-none transition focus:border-[#f53003] focus:ring-2 focus:ring-[#f0dad8] dark:border-[#3E3E3A] dark:bg-[#101010] dark:text-[#F7F7F5] dark:focus:border-[#f53003]" required />
                    </div>

                    <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-3">
                        <div>
                            <label for="type" class="mb-2 block text-sm font-medium text-[#1b1b18] dark:text-white">Tipe</label>
                            <select id="type" name="type" class="w-full rounded-[18px] border border-[#e3e3e0] bg-white px-4 py-3 text-sm text-[#1b1b18] shadow-sm outline-none transition focus:border-[#f53003] focus:ring-2 focus:ring-[#f0dad8] dark:border-[#3E3E3A] dark:bg-[#101010] dark:text-[#F7F7F5] dark:focus:border-[#f53003]">
                                <option value="post" {{ old('type', $note->type) == 'post' ? 'selected' : '' }}>Post (Blog)</option>
                                <option value="page" {{ old('type', $note->type) == 'page' ? 'selected' : '' }}>Page (Statis)</option>
                            </select>
                        </div>
                        <div>
                            <label for="category_id" class="mb-2 block text-sm font-medium text-[#1b1b18] dark:text-white">Kategori</label>
                            <select id="category_id" name="category_id" class="w-full rounded-[18px] border border-[#e3e3e0] bg-white px-4 py-3 text-sm text-[#1b1b18] shadow-sm outline-none transition focus:border-[#f53003] focus:ring-2 focus:ring-[#f0dad8] dark:border-[#3E3E3A] dark:bg-[#101010] dark:text-[#F7F7F5] dark:focus:border-[#f53003]">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $note->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="status" class="mb-2 block text-sm font-medium text-[#1b1b18] dark:text-white">Status</label>
                            <select id="status" name="status" class="w-full rounded-[18px] border border-[#e3e3e0] bg-white px-4 py-3 text-sm text-[#1b1b18] shadow-sm outline-none transition focus:border-[#f53003] focus:ring-2 focus:ring-[#f0dad8] dark:border-[#3E3E3A] dark:bg-[#101010] dark:text-[#F7F7F5] dark:focus:border-[#f53003]">
                                <option value="draft" {{ old('status', $note->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $note->status) == 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="editor" class="mb-2 block text-sm font-medium text-[#1b1b18] dark:text-white">Isi Konten</label>
                        <textarea id="editor" name="note">{{ old('note', $note->content) }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label for="tags" class="mb-2 block text-sm font-medium text-[#1b1b18] dark:text-white">Tags</label>
                        <input id="tags" name="tags" type="text" value="{{ old('tags', $note->tags) }}" placeholder="contoh: meeting, ide, tugas" class="w-full rounded-[18px] border border-[#e3e3e0] bg-white px-4 py-3 text-sm text-[#1b1b18] shadow-sm outline-none transition focus:border-[#f53003] focus:ring-2 focus:ring-[#f0dad8] dark:border-[#3E3E3A] dark:bg-[#101010] dark:text-[#F7F7F5] dark:focus:border-[#f53003]" />
                    </div>

                    <div class="mb-8">
                        <label for="attachment" class="mb-2 block text-sm font-medium text-[#1b1b18] dark:text-white">Upload (Opsional)</label>
                        <input id="attachment" name="attachment" type="file" accept="image/*,.pdf,.doc,.docx" class="w-full rounded-[18px] border border-[#e3e3e0] bg-white px-4 py-3 text-sm text-[#1b1b18] shadow-sm outline-none transition file:mr-4 file:rounded-full file:border-0 file:bg-[#f3f1ef] file:px-3 file:py-2 file:text-sm file:font-medium dark:border-[#3E3E3A] dark:bg-[#101010] dark:text-[#F7F7F5] dark:file:bg-[#1a1a1a]" />
                        @if ($note->attachment_path)
                            <p class="mt-2 text-xs text-[#6f6d69] dark:text-[#A1A09A]">File saat ini: <a href="{{ asset('storage/' . $note->attachment_path) }}" class="text-[#f53003] hover:underline" target="_blank">Lihat Lampiran</a></p>
                        @endif
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div class="text-sm text-[#6f6d69] dark:text-[#A1A09A]">Perubahan akan disimpan secara permanen.</div>
                        <div class="flex gap-3">
                            <a href="{{ route('notes.show', $note) }}" class="inline-flex items-center justify-center rounded-2xl border border-[#e3e3e0] px-5 py-3 text-sm font-semibold text-[#1b1b18] transition hover:bg-[#F4F2F0] dark:border-[#3E3E3A] dark:text-[#F7F7F5] dark:hover:bg-[#141414]">Batal</a>
                            <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-[#f53003] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#d72a02]">Perbarui Catatan</button>
                        </div>
                    </div>
                </form>
            </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: '#editor',
            license_key: 'gpl',
            plugins: 'image code table lists link media wordcount autoresize',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | bullist numlist | link image media | code blockquote',
            menubar: false,
            min_height: 400,
            skin: (window.matchMedia('(prefers-color-scheme: dark)').matches) ? 'oxide-dark' : 'oxide',
            content_css: (window.matchMedia('(prefers-color-scheme: dark)').matches) ? 'dark' : 'default',
            images_upload_url: '{{ route("ckeditor.upload") }}',
            automatic_uploads: true,
            relative_urls: false,
            remove_script_host: false,
            document_base_url: '{{ url("/") }}/',
            content_style: 'body { font-family:Inter,Arial,sans-serif; font-size:16px } img { max-width: 100%; height: auto; border-radius: 8px; }',
            images_upload_handler: (blobInfo, progress) => new Promise((resolve, reject) => {
                const xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '{{ route("ckeditor.upload") }}');
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                xhr.upload.onprogress = (e) => {
                    progress(e.loaded / e.total * 100);
                };

                xhr.onload = () => {
                    if (xhr.status === 403) {
                        reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
                        return;
                    }

                    if (xhr.status < 200 || xhr.status >= 300) {
                        reject('HTTP Error: ' + xhr.status);
                        return;
                    }

                    const json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.url != 'string') {
                        reject('Invalid JSON: ' + xhr.responseText);
                        return;
                    }

                    resolve(json.url);
                };

                xhr.onerror = () => {
                    reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
                };

                const formData = new FormData();
                formData.append('upload', blobInfo.blob(), blobInfo.filename());

                xhr.send(formData);
            })
        });
    </script>
@endsection
