@extends('layouts.app')

@section('content')
    <p class="text-sm font-bold uppercase tracking-[0.18em] text-amber-700">Update place</p>
    <h1 class="mb-6 mt-1 text-3xl font-black tracking-tight sm:text-4xl">Edit Eatery</h1>
    <form method="POST" action="{{ route('eateries.update', $eatery) }}" class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
        @csrf
        @method('PUT')
        @include('eateries._form')
        <button type="submit" class="mt-6 rounded bg-amber-700 px-4 py-2 text-white">Update Eatery</button>
    </form>
@endsection
