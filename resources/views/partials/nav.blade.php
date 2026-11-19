<nav class="border-b border-amber-200 bg-white">
    <div class="mx-auto flex max-w-6xl flex-wrap items-center gap-5 px-4 py-4">
        <a class="font-bold text-amber-800" href="{{ route('home') }}">{{ config('kaonta.site_title') }}</a>
        <a href="{{ route('home') }}" class="text-sm hover:text-amber-700">Home</a>
        <a href="{{ route('eateries.index') }}" class="text-sm hover:text-amber-700">Eateries</a>
        <a href="{{ route('districts.index') }}" class="text-sm hover:text-amber-700">Districts</a>
        <a href="{{ route('eateries.create') }}" class="rounded bg-amber-700 px-3 py-2 text-sm text-white">Add Eatery</a>
    </div>
</nav>
