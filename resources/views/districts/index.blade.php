@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold">Districts</h1>
    <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($districts as $district)
            <a href="{{ route('districts.show', $district) }}" class="rounded border border-amber-200 bg-white p-5 font-semibold hover:border-amber-500">
                {{ $district->name }}
                <span class="block text-sm font-normal text-slate-600">{{ $district->eateries_count }} {{ $district->eateries_count === 1 ? 'eatery' : 'eateries' }}</span>
            </a>
        @endforeach
    </div>
@endsection
