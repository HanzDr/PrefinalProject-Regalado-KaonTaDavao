@extends('layouts.app')

@section('content')
    <section class="overflow-hidden rounded-3xl bg-slate-950 px-6 py-10 text-white shadow-xl sm:px-10">
        <p class="text-sm font-bold uppercase tracking-[0.18em] text-amber-400">Davao City guide</p>
        <h1 class="mt-2 max-w-3xl text-3xl font-black tracking-tight sm:text-5xl">{{ config('kaonta.site_title') }}</h1>
        <p class="mt-4 max-w-2xl text-slate-300">Discover neighborhood favorites, signature dishes, permits, and local reviews.</p>
    </section>
    <div class="mt-5 grid gap-4 sm:grid-cols-3">
        <p class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"><strong class="block text-3xl text-slate-950">{{ $eateryCount }}</strong><span class="text-sm text-slate-500">Eateries</span></p>
        <p class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"><strong class="block text-3xl text-slate-950">{{ $districtCount }}</strong><span class="text-sm text-slate-500">Districts</span></p>
        <p class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"><strong class="block text-3xl text-slate-950">{{ $reviewCount }}</strong><span class="text-sm text-slate-500">Reviews</span></p>
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
