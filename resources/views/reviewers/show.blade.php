@extends('layouts.app')

@section('content')
    <p class="text-sm font-bold uppercase tracking-[0.18em] text-amber-700">Reviewer</p>
    <h1 class="mt-1 text-3xl font-black tracking-tight sm:text-4xl">{{ $user->name }}</h1>
    <p class="mt-2 text-slate-700">{{ $user->reviews_count }} {{ $user->reviews_count === 1 ? 'review written' : 'reviews written' }}</p>
    <div class="mt-6 space-y-4">
        @foreach ($user->reviews as $review)
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <p>
                    <a href="{{ route('eateries.show', $review->eatery) }}" class="font-bold underline">{{ $review->eatery->name }}</a>
                    — <x-rating :rating="$review->rating" />
                </p>
                <p class="mt-2">{{ $review->body }}</p>
            </article>
        @endforeach
    </div>
@endsection
