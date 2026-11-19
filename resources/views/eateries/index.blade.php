@extends('layouts.app')

@section('content')
    <div class="flex items-end justify-between gap-4">
        <div>
            <p class="text-sm font-bold uppercase tracking-[0.18em] text-amber-700">Davao food guide</p>
            <h1 class="mt-1 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Eateries</h1>
        </div>
        <p class="hidden text-sm text-slate-500 sm:block">{{ $eateries->total() }} places</p>
    </div>
    <form method="GET" action="{{ route('eateries.index') }}" class="mt-6 grid gap-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:grid-cols-2 lg:grid-cols-[1.4fr_1fr_1fr_auto]">
        <div>
            <label for="q" class="block text-sm font-medium">Search</label>
            <input id="q" name="q" type="text" value="{{ request('q') }}" placeholder="Name or specialty" class="mt-1 w-full rounded-xl border-slate-200 bg-slate-50 px-3 py-2.5 outline-none transition focus:border-amber-400 focus:ring-2 focus:ring-amber-100">
        </div>
        <div>
            <label for="district" class="block text-sm font-medium">District</label>
            <select id="district" name="district" class="mt-1 w-full rounded-xl border-slate-200 bg-slate-50 px-3 py-2.5 outline-none transition focus:border-amber-400 focus:ring-2 focus:ring-amber-100">
                <option value="">All districts</option>
                @foreach ($districts as $district)
                    <option value="{{ $district->id }}" @selected(request('district') == $district->id)>{{ $district->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="feature" class="block text-sm font-medium">Feature</label>
            <select id="feature" name="feature" class="mt-1 w-full rounded-xl border-slate-200 bg-slate-50 px-3 py-2.5 outline-none transition focus:border-amber-400 focus:ring-2 focus:ring-amber-100">
                <option value="">All features</option>
                @foreach ($features as $feature)
                    <option value="{{ $feature->name }}" @selected(request('feature') == $feature->name)>{{ $feature->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex items-end">
            <button type="submit" class="w-full rounded-xl bg-slate-950 px-5 py-2.5 font-semibold text-white shadow-sm transition hover:bg-amber-600">Filter</button>
        </div>
    </form>

    @if ($eateries->isEmpty())
        <p class="mt-8 rounded border border-slate-200 bg-white p-6 text-center">No eateries match your filters</p>
    @else
        <div class="mt-8 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($eateries as $eatery)
                <x-eatery-card :eatery="$eatery" />
            @endforeach
        </div>
        <div class="mt-6">{{ $eateries->links() }}</div>
    @endif
@endsection
