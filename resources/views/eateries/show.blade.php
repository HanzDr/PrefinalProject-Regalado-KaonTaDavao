@extends('layouts.app')

@section('content')
    <div class="rounded-lg border border-amber-200 bg-white p-6">
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold">{{ $eatery->name }}</h1>
                @if (! $eatery->is_open)
                    <span class="mt-2 inline-block rounded bg-red-100 px-2 py-1 text-sm font-semibold text-red-700">Closed</span>
                @endif
            </div>
            <div class="flex gap-2">
                <a href="{{ route('eateries.edit', $eatery) }}" class="rounded border border-amber-700 px-3 py-2 text-amber-800">Edit</a>
                <form method="POST" action="{{ route('eateries.destroy', $eatery) }}" onsubmit="return confirm('Delete this eatery?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="rounded bg-red-700 px-3 py-2 text-white">Delete</button>
                </form>
            </div>
        </div>

        <p class="mt-3"><a href="{{ route('districts.show', $eatery->district) }}" class="underline">{{ $eatery->district->name }}</a></p>
        <p class="mt-1">{{ $eatery->address }}</p>
        <p class="mt-1">{{ $eatery->price_range === 'budget' ? '₱' : ($eatery->price_range === 'mid' ? '₱₱' : '₱₱₱') }}</p>
        @if ($eatery->specialty)<p class="mt-1">{{ $eatery->specialty }}</p>@endif
        <div class="mt-3 flex flex-wrap gap-2">
            @foreach ($eatery->features as $feature)
                <a href="{{ route('eateries.index', ['feature' => $feature->name]) }}" class="rounded-full bg-amber-100 px-2 py-1 text-xs">{{ $feature->name }}</a>
            @endforeach
        </div>

        @if ($eatery->permit)
            <section class="mt-6 rounded border border-slate-200 p-4">
                <h2 class="font-bold">Permit</h2>
                <p>{{ $eatery->permit->permit_no }}</p>
                <p>{{ $eatery->permit->expires_on->format('F j, Y') }}</p>
                @if ($eatery->permit->expires_on->isBefore(today()))
                    <p class="font-bold text-red-700">Permit expired</p>
                @endif
            </section>
        @endif

        <section class="mt-6">
            <h2 class="text-xl font-bold">Dishes</h2>
            @foreach ($eatery->dishes as $dish)
                <p class="mt-2">{{ $dish->name }} — ₱{{ number_format((float) $dish->price, 2) }}
                    @if ($dish->is_bestseller)<strong class="ml-2 text-amber-800">Bestseller</strong>@endif
                </p>
            @endforeach
        </section>

        <section class="mt-6">
            <h2 class="text-xl font-bold">Reviews</h2>
            @foreach ($eatery->reviews as $review)
                <article class="mt-3 border-t border-slate-200 pt-3">
                    <p>
                        <a href="{{ route('reviewers.show', $review->user) }}" class="font-semibold underline">{{ $review->user->name }}</a>
                        — <x-rating :rating="$review->rating" />
                    </p>
                    <p class="text-sm text-slate-600">{{ $review->created_at->format('F j, Y') }}</p>
                    <p class="mt-1">{{ $review->body }}</p>
                    <form method="POST" action="{{ route('reviews.destroy', $review) }}" class="mt-2" onsubmit="return confirm('Delete this review?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm text-red-700">Delete</button>
                    </form>
                </article>
            @endforeach
        </section>

        @if ($eatery->is_open)
            <section class="mt-6">
                <h2 class="text-xl font-bold">Write a Review</h2>
                @if ($errors->any())
                    <div class="mt-3 rounded border border-red-300 bg-red-50 p-3">
                        @foreach ($errors->all() as $error)<p class="text-sm text-red-700">{{ $error }}</p>@endforeach
                    </div>
                @endif
                <form method="POST" action="{{ route('eateries.reviews.store', $eatery) }}" class="mt-3 grid gap-3">
                    @csrf
                    <div>
                        <label for="user_id">Reviewer</label>
                        <select id="user_id" name="user_id" class="mt-1 w-full rounded border p-2">
                            <option value="">Choose reviewer</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @selected(old('user_id') == $user->id)>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')<p class="text-sm text-red-700">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="rating">Rating</label>
                        <input id="rating" name="rating" type="number" min="1" max="5" value="{{ old('rating') }}" class="mt-1 w-full rounded border p-2">
                        @error('rating')<p class="text-sm text-red-700">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="body">Review</label>
                        <textarea id="body" name="body" rows="4" class="mt-1 w-full rounded border p-2">{{ old('body') }}</textarea>
                        @error('body')<p class="text-sm text-red-700">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="rounded bg-amber-700 px-4 py-2 text-white md:w-fit">Post Review</button>
                </form>
            </section>
        @else
            <p class="mt-6 font-semibold">This eatery is closed. Reviews are paused.</p>
        @endif
    </div>
@endsection
