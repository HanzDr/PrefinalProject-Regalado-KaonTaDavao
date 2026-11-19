<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eatery;
use App\Models\District;
use App\Models\Review;

class HomeController extends Controller
{
    public function __invoke()
    {
        $topRated = Eatery::query()
            ->with(['district', 'features'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->having('reviews_count', '>', 0)
            ->orderByDesc('reviews_avg_rating')
            ->orderBy('name')
            ->limit(3)
            ->get();

        return view('home', [
            'eateryCount' => Eatery::count(),
            'districtCount' => District::count(),
            'reviewCount' => Review::count(),
            'topRated' => $topRated,
        ]);
    }
}
