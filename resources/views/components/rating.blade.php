@props(['rating' => null, 'count' => null])
@if ($rating !== null)
    @php($full = (int) round($rating))
    <span>{{ number_format((float) $rating, 1) }} ★</span>
    @if ($count !== null)
        <span>({{ $count }} {{ $count === 1 ? 'review' : 'reviews' }})</span>
    @endif
@else
    <span>No reviews yet</span>
@endif
