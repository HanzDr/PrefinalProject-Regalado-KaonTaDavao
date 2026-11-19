@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold">{{ config('kaonta.site_title') }}</h1>
    <div class="mt-6 grid gap-4 sm:grid-cols-3">
        <p class="rounded border border-amber-200 bg-white p-5"><strong>{{ $eateryCount }}</strong> eateries</p>
        <p class="rounded border border-amber-200 bg-white p-5"><strong>{{ $districtCount }}</strong> districts</p>
        <p class="rounded border border-amber-200 bg-white p-5"><strong>{{ $reviewCount }}</strong> reviews</p>
    </div>
    <section class="mt-8">
        <h2 class="mb-4 text-2xl font-bold">Top Rated</h2>
        @if ($topRated->isNotEmpty())
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($topRated as $eatery)
                    <x-eatery-card :eatery="$eatery" />
                @endforeach
            </div>
        @endif
    </section>
@endsection
