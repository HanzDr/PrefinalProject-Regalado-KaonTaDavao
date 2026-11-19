@extends('layouts.app')

@section('content')
    <p class="text-sm font-bold uppercase tracking-[0.18em] text-amber-700">Explore Davao</p>
    <h1 class="mt-1 text-3xl font-black tracking-tight sm:text-4xl">Districts</h1>
    <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($districts as $district)
            <a href="{{ route('districts.show', $district) }}" class="rounded-2xl border border-slate-200 bg-white p-5 font-bold shadow-sm transition hover:-translate-y-1 hover:border-amber-300 hover:shadow-lg">
                {{ $district->name }}
                <span class="block text-sm font-normal text-slate-600">{{ $district->eateries_count }} {{ $district->eateries_count === 1 ? 'eatery' : 'eateries' }}</span>
            </a>
        @endforeach
    </div>
@endsection
