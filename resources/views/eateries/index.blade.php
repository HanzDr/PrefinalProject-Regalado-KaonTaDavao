@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold">Eateries</h1>
    <form method="GET" action="{{ route('eateries.index') }}" class="mt-6 grid gap-3 rounded border border-amber-200 bg-white p-4 md:grid-cols-4">
        <div>
            <label for="q" class="block text-sm font-medium">Search</label>
            <input id="q" name="q" type="text" value="{{ request('q') }}" class="mt-1 w-full rounded border p-2">
        </div>
        <div>
            <label for="district" class="block text-sm font-medium">District</label>
            <select id="district" name="district" class="mt-1 w-full rounded border p-2">
                <option value="">All districts</option>
                @foreach ($districts as $district)
                    <option value="{{ $district->id }}" @selected(request('district') == $district->id)>{{ $district->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="feature" class="block text-sm font-medium">Feature</label>
            <select id="feature" name="feature" class="mt-1 w-full rounded border p-2">
                <option value="">All features</option>
                @foreach ($features as $feature)
                    <option value="{{ $feature->name }}" @selected(request('feature') == $feature->name)>{{ $feature->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex items-end">
            <button type="submit" class="rounded bg-amber-700 px-4 py-2 text-white">Filter</button>
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
