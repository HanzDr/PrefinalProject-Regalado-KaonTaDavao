@extends('layouts.app')

@section('content')
    <p class="text-sm font-bold uppercase tracking-[0.18em] text-amber-700">District</p>
    <h1 class="mt-1 text-3xl font-black tracking-tight sm:text-4xl">{{ $district->name }}</h1>
    <p class="mt-2 rounded-full bg-amber-50 px-3 py-1 text-sm font-semibold text-amber-800 ring-1 ring-amber-100 inline-block">{{ $district->reviews_count }} {{ $district->reviews_count === 1 ? 'review' : 'reviews' }} in {{ $district->name }}</p>
    @if ($district->eateries->isNotEmpty())
        <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($district->eateries as $eatery)
                <x-eatery-card :eatery="$eatery" />
            @endforeach
        </div>
    @endif
@endsection
