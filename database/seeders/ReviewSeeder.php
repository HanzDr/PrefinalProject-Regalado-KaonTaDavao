<?php

namespace Database\Seeders;

use App\Models\Eatery;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $handMade = Eatery::where('slug', 'carinderia-ni-regalado')->firstOrFail();
        $tita = User::where('email', 'tita.regalado@kaonta.test')->firstOrFail();
        $users = User::all();

        $handMade->reviews()->create([
            'user_id' => $tita->id,
            'rating' => 5,
            'body' => 'Lami kaayo! Balik-balikan ni Tita Regalado.',
        ]);

        foreach ($users as $user) {
            if ($user->id !== $tita->id) {
                $handMade->reviews()->create([
                    'user_id' => $user->id,
                    'rating' => fake()->numberBetween(3, 5),
                    'body' => fake()->paragraph(),
                ]);
            }
        }

        foreach (Eatery::where('is_open', true)->where('id', '!=', $handMade->id)->get() as $eatery) {
            for ($i = 0; $i < fake()->numberBetween(0, 6); $i++) {
                $eatery->reviews()->create([
                    'user_id' => $users->random()->id,
                    'rating' => fake()->numberBetween(1, 5),
                    'body' => fake()->paragraph(),
                ]);
            }
        }
    }
}
