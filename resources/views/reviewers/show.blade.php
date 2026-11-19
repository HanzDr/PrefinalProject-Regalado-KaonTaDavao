@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
    <p class="mt-2 text-slate-700">{{ $user->reviews_count }} {{ $user->reviews_count === 1 ? 'review written' : 'reviews written' }}</p>
    <div class="mt-6 space-y-4">
        @foreach ($user->reviews as $review)
            <article class="rounded border border-amber-200 bg-white p-5">
                <p>
                    <a href="{{ route('eateries.show', $review->eatery) }}" class="font-bold underline">{{ $review->eatery->name }}</a>
                    — <x-rating :rating="$review->rating" />
                </p>
                <p class="mt-2">{{ $review->body }}</p>
            </article>
        @endforeach
    </div>
@endsection
