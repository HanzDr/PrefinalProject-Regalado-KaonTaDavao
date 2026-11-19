@if (session('success'))
    <div class="mx-auto mt-4 max-w-6xl px-4">
        <p class="rounded border border-green-300 bg-green-50 px-4 py-3 text-green-800">{{ session('success') }}</p>
    </div>
@endif
