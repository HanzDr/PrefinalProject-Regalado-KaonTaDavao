@props(['eatery'])
<article class="rounded-lg border border-amber-200 bg-white p-5 shadow-sm">
    <div class="flex items-start justify-between gap-3">
        <div>
            <a href="{{ route('eateries.show', $eatery) }}" class="text-lg font-bold text-amber-900 hover:underline">{{ $eatery->name }}</a>
            <p>
                <a href="{{ route('districts.show', $eatery->district) }}" class="text-sm text-slate-600 hover:underline">{{ $eatery->district->name }}</a>
            </p>
        </div>
        @if (! $eatery->is_open)
            <span class="rounded bg-red-100 px-2 py-1 text-xs font-semibold text-red-700">Closed</span>
        @endif
    </div>
    <p class="mt-3">
        @if ($eatery->price_range === 'budget')
            ₱
        @elseif ($eatery->price_range === 'mid')
            ₱₱
        @else
            ₱₱₱
        @endif
    </p>
    @if ($eatery->specialty)
        <p class="mt-1 text-sm text-slate-700">{{ $eatery->specialty }}</p>
    @endif
    <div class="mt-3 flex flex-wrap gap-2">
        @foreach ($eatery->features as $feature)
            <a href="{{ route('eateries.index', ['feature' => $feature->name]) }}" class="rounded-full bg-amber-100 px-2 py-1 text-xs text-amber-900">{{ $feature->name }}</a>
        @endforeach
    </div>
    <p class="mt-4 text-sm">
        @if ($eatery->reviews_count)
            <x-rating :rating="$eatery->reviews_avg_rating" :count="$eatery->reviews_count" />
        @else
            <x-rating />
        @endif
    </p>
</article>
