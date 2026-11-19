@extends('layouts.app')

@section('content')
    <h1 class="mb-6 text-3xl font-bold">Edit Eatery</h1>
    <form method="POST" action="{{ route('eateries.update', $eatery) }}" class="rounded-lg border border-amber-200 bg-white p-6">
        @csrf
        @method('PUT')
        @include('eateries._form')
        <button type="submit" class="mt-6 rounded bg-amber-700 px-4 py-2 text-white">Update Eatery</button>
    </form>
@endsection
