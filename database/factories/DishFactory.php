<?php

namespace Database\Factories;

use App\Models\Dish;
use App\Models\Eatery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Dish>
 */
class DishFactory extends Factory
{
    protected $model = Dish::class;

    public function definition(): array
    {
        return [
            'eatery_id' => Eatery::factory(),
            'name' => fake()->randomElement(['Adobong Manok', 'Pork Sinigang', 'Grilled Tuna', 'Chicken Inasal', 'Ginisang Monggo']),
            'price' => fake()->randomFloat(2, 50, 250),
            'is_bestseller' => fake()->boolean(20),
        ];
    }
}
