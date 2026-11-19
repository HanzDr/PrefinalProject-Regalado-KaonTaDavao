<nav class="sticky top-0 z-30 border-b border-slate-200/80 bg-white/95 backdrop-blur">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid min-h-16 grid-cols-1 items-center gap-3 py-3 sm:grid-cols-[minmax(0,1fr)_auto] sm:py-0">
            <a class="flex min-w-0 items-center gap-3" href="{{ route('home') }}">
                <span class="flex size-9 shrink-0 items-center justify-center rounded-xl bg-amber-500 text-lg text-white shadow-sm">K</span>
                <span class="truncate text-sm font-bold text-slate-950 sm:text-base">{{ config('kaonta.site_title') }}</span>
            </a>
            <div class="grid grid-cols-4 gap-1 sm:flex sm:items-center sm:gap-1">
                <a href="{{ route('home') }}" class="rounded-lg px-2 py-2 text-center text-xs font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-950 sm:px-3 sm:text-sm">Home</a>
                <a href="{{ route('eateries.index') }}" class="rounded-lg px-2 py-2 text-center text-xs font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-950 sm:px-3 sm:text-sm">Eateries</a>
                <a href="{{ route('districts.index') }}" class="rounded-lg px-2 py-2 text-center text-xs font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-950 sm:px-3 sm:text-sm">Districts</a>
                <a href="{{ route('eateries.create') }}" class="rounded-lg bg-slate-950 px-2 py-2 text-center text-xs font-semibold text-white shadow-sm transition hover:bg-amber-600 sm:px-4 sm:text-sm">Add Eatery</a>
            </div>
        </div>
    </div>
</nav>
