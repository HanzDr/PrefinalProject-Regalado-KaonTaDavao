@if (session('success'))
    <div class="mx-auto mt-4 max-w-7xl px-4 sm:px-6 lg:px-8">
        <p class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-800 shadow-sm">{{ session('success') }}</p>
    </div>
@endif
