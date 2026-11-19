<?php

namespace Tests\Feature;

use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use App\Models\Permit;
use App\Models\Review;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SeedingTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_seeder_produces_exact_section_8_data(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseCount('districts', 6);
        $this->assertDatabaseCount('features', 6);
        $this->assertDatabaseCount('users', 12);
        $this->assertDatabaseCount('eateries', 15);
        $this->assertDatabaseCount('permits', 15);
        $this->assertSame(3, Eatery::where('is_open', false)->count());

        $this->assertSame(1, District::where('name', 'Poblacion')->count());
        $this->assertSame(1, Feature::where('name', 'Suki ni Regalado')->count());

        $primary = User::where('email', 'derrenhanz@kaonta.test')->first();
        $tita = User::where('email', 'tita.regalado@kaonta.test')->first();
        $this->assertNotNull($primary);
        $this->assertNotNull($tita);
        $this->assertSame('Derren Hanz Regalado', $primary->name);
        $this->assertSame('Tita Regalado', $tita->name);
        $this->assertTrue(Hash::check('kaonta2026', $primary->password));
        $this->assertTrue(Hash::check('kaonta2026', $tita->password));

        $eatery = Eatery::where('slug', 'carinderia-ni-regalado')->first();
        $this->assertNotNull($eatery);
        $this->assertSame('Carinderia ni Regalado', $eatery->name);
        $this->assertSame('Poblacion', $eatery->district->name);
        $this->assertSame('San Pedro St., Poblacion, Davao City', $eatery->address);
        $this->assertSame('budget', $eatery->price_range);
        $this->assertSame('Tinolang Manok', $eatery->specialty);
        $this->assertTrue($eatery->is_open);
        $this->assertSame(
            ['Budget Meal', 'Suki ni Regalado'],
            $eatery->features()->pluck('features.name')->sort()->values()->all()
        );
        $this->assertSame('DVO-2026-1203', $eatery->permit->permit_no);
        $this->assertSame('2027-12-03', $eatery->permit->expires_on->format('Y-m-d'));
        $this->assertSame(3, $eatery->dishes()->count());
        $this->assertGreaterThanOrEqual(3, $eatery->reviews()->count());

        $this->assertSame(1, $eatery->dishes()->where('name', 'Tinolang Manok')
            ->where('price', 85.00)->where('is_bestseller', true)->count());
        $this->assertSame(1, $eatery->dishes()->where('name', 'Kinilaw na Tuna')
            ->where('price', 120.00)->where('is_bestseller', false)->count());
        $this->assertSame(1, $eatery->dishes()->where('name', 'Durian Shake')
            ->where('price', 75.00)->where('is_bestseller', false)->count());

        $this->assertSame(1, Review::where('body', 'Lami kaayo! Balik-balikan ni Tita Regalado.')
            ->where('rating', 5)
            ->count());

        $this->assertGreaterThanOrEqual(1, Permit::where('expires_on', '<', now())->count());

        foreach (Eatery::where('slug', '!=', 'carinderia-ni-regalado')->get() as $factoryEatery) {
            $dishCount = $factoryEatery->dishes()->count();
            $featureCount = $factoryEatery->features()->count();
            $this->assertSame(1, $factoryEatery->permit()->count());
            $this->assertGreaterThanOrEqual(2, $dishCount);
            $this->assertLessThanOrEqual(5, $dishCount);
            $this->assertGreaterThanOrEqual(1, $featureCount);
            $this->assertLessThanOrEqual(3, $featureCount);
        }

        $closedIds = Eatery::where('is_open', false)->pluck('id');
        $this->assertSame(0, Review::whereIn('eatery_id', $closedIds)->count());
    }
}
