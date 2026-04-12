<header class="border-b border-[#e3e3e0] bg-white/90 px-6 py-3 shadow-sm backdrop-blur-sm dark:border-[#3E3E3A] dark:bg-[#0a0a0a]/90">
    <div class="mx-auto flex max-w-6xl items-center justify-between gap-4">
        <a href="{{ route('home') }}" class="text-lg font-bold text-[#f53003] dark:text-[#ff6b35] transition hover:opacity-80">{{ config('app.name', 'RamziNotes') }}</a>
        
        <!-- Search Form -->
        <form method="GET" action="{{ route('home') }}" class="flex flex-1 max-w-md gap-2">
            <input type="text" name="q" placeholder="Cari catatan..." value="{{ request('q', '') }}" class="flex-1 rounded-[16px] border border-[#e3e3e0] bg-white px-4 py-2 text-sm text-[#1b1b18] shadow-sm outline-none transition focus:border-[#f53003] focus:ring-2 focus:ring-[#f0dad8] dark:border-[#3E3E3A] dark:bg-[#101010] dark:text-[#F7F7F5] dark:focus:border-[#f53003]" />
            <button type="submit" class="rounded-[16px] bg-[#f53003] px-4 py-2 text-sm font-medium text-white transition hover:bg-[#d72a02]">Cari</button>
            @if (request('q'))
                <a href="{{ route('home') }}" class="rounded-[16px] border border-[#e3e3e0] px-4 py-2 text-sm font-medium text-[#1b1b18] transition hover:bg-[#F4F2F0] dark:border-[#3E3E3A] dark:text-[#F7F7F5] dark:hover:bg-[#141414]">Reset</a>
            @endif
        </form>

        <a href="{{ route('notes.create') }}" class="rounded-2xl bg-[#f53003] px-4 py-2 text-sm font-medium text-white transition hover:bg-[#d72a02]">Tambah Catatan</a>
    </div>
</header>
