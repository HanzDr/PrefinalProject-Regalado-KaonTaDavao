<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([config('kaonta.feature_name'), 'Budget Meal', 'Halal', 'Open 24 Hours', 'Aircon', 'Parking'] as $name) {
            Feature::create(['name' => $name]);
        }
    }
}
