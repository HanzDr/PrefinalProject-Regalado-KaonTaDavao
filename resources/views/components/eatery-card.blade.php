@props(['eatery'])
<article class="group h-full overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-amber-300 hover:shadow-lg">
    <div class="flex items-start justify-between gap-3">
        <div>
            <a href="{{ route('eateries.show', $eatery) }}" class="text-lg font-bold text-slate-950 transition group-hover:text-amber-700">{{ $eatery->name }}</a>
            <p>
                <a href="{{ route('districts.show', $eatery->district) }}" class="text-sm text-slate-600 hover:underline">{{ $eatery->district->name }}</a>
            </p>
        </div>
        @if (! $eatery->is_open)
            <span class="shrink-0 rounded-full bg-red-50 px-2.5 py-1 text-xs font-bold text-red-700">Closed</span>
        @endif
    </div>
    <div class="mt-5 flex items-center justify-between gap-3 border-t border-slate-100 pt-4">
        <p class="font-bold text-amber-700">
            @if ($eatery->price_range === 'budget')
                ₱
            @elseif ($eatery->price_range === 'mid')
                ₱₱
            @else
                ₱₱₱
            @endif
        </p>
        @if ($eatery->specialty)
            <p class="text-right text-sm font-medium text-slate-700">{{ $eatery->specialty }}</p>
        @endif
    </div>
    <div class="mt-4 flex flex-wrap gap-2">
        @foreach ($eatery->features as $feature)
            <a href="{{ route('eateries.index', ['feature' => $feature->name]) }}" class="rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-800 ring-1 ring-amber-100">{{ $feature->name }}</a>
        @endforeach
    </div>
    <p class="mt-5 text-sm text-slate-700">
        @if ($eatery->reviews_count)
            <x-rating :rating="$eatery->reviews_avg_rating" :count="$eatery->reviews_count" />
        @else
            <x-rating />
        @endif
    </p>
</article>
