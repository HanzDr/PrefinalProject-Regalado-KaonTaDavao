<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => config('kaonta.user_name'),
            'email' => config('kaonta.user_email'),
            'password' => Hash::make('kaonta2026'),
        ]);
        User::factory()->create([
            'name' => config('kaonta.tita_name'),
            'email' => config('kaonta.tita_email'),
            'password' => Hash::make('kaonta2026'),
        ]);
        User::factory(10)->create();
    }
}
