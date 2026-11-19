<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use Database\Factories\DishFactory;
use Database\Factories\EateryFactory;
use Database\Factories\PermitFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EaterySeeder extends Seeder
{
    public function run(): void
    {
        $poblacion = District::where('name', 'Poblacion')->firstOrFail();
        $suki = Feature::where('name', 'Suki ni Regalado')->firstOrFail();
        $budget = Feature::where('name', 'Budget Meal')->firstOrFail();

        $handMade = Eatery::create([
            'district_id' => $poblacion->id,
            'name' => 'Carinderia ni Regalado',
            'slug' => Str::slug('Carinderia ni Regalado'),
            'address' => 'San Pedro St., Poblacion, Davao City',
            'price_range' => 'budget',
            'specialty' => 'Tinolang Manok',
            'is_open' => true,
        ]);
        $handMade->permit()->create([
            'permit_no' => 'DVO-2026-1203',
            'expires_on' => '2027-12-03',
        ]);
        $handMade->features()->sync([$suki->id, $budget->id]);
        $handMade->dishes()->createMany([
            ['name' => 'Tinolang Manok', 'price' => 85.00, 'is_bestseller' => true],
            ['name' => 'Kinilaw na Tuna', 'price' => 120.00, 'is_bestseller' => false],
            ['name' => 'Durian Shake', 'price' => 75.00, 'is_bestseller' => false],
        ]);

        $closed = Eatery::factory()->closed()->count(3)->create();
        $open = Eatery::factory()->count(11)->create();

        foreach ($closed->concat($open) as $index => $eatery) {
            if ($index === 0) {
                $eatery->permit()->create([
                    'permit_no' => 'DVO-2026-1000',
                    'expires_on' => '2020-01-01',
                ]);
            } else {
                $eatery->permit()->create([
                    'permit_no' => fake()->unique()->numerify('DVO-2026-#####'),
                    'expires_on' => fake()->dateTimeBetween('+1 day', '+2 years')->format('Y-m-d'),
                ]);
            }

            $eatery->dishes()->createMany(
                collect(range(1, fake()->numberBetween(2, 5)))->map(fn () => [
                    'name' => fake()->randomElement(['Adobong Manok', 'Pork Sinigang', 'Grilled Tuna', 'Chicken Inasal', 'Ginisang Monggo']),
                    'price' => fake()->randomFloat(2, 50, 250),
                    'is_bestseller' => fake()->boolean(20),
                ])->all()
            );

            $eatery->features()->attach(
                Feature::inRandomOrder()->limit(fake()->numberBetween(1, 3))->pluck('id')->all()
            );
        }
    }
}
