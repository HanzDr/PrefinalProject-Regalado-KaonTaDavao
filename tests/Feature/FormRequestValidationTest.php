<?php

namespace Tests\Feature;

use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use App\Models\Permit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FormRequestValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_closed_eatery_review_returns_forbidden(): void
    {
        $district = District::create(['name' => 'Poblacion']);
        $eatery = Eatery::create([
            'district_id' => $district->id,
            'name' => 'Closed Eatery',
            'slug' => 'closed-eatery',
            'address' => 'Davao',
            'price_range' => 'budget',
            'specialty' => null,
            'is_open' => false,
        ]);
        $user = User::factory()->create();

        $this->post(route('eateries.reviews.store', $eatery), [
            'user_id' => $user->id,
            'rating' => 5,
            'body' => 'This review is long enough.',
        ])->assertForbidden();

        $this->assertDatabaseCount('reviews', 0);
    }

    public function test_review_custom_messages_are_personalized(): void
    {
        $district = District::create(['name' => 'Poblacion']);
        $eatery = Eatery::create([
            'district_id' => $district->id,
            'name' => 'Open Eatery',
            'slug' => 'open-eatery',
            'address' => 'Davao',
            'price_range' => 'mid',
            'specialty' => null,
            'is_open' => true,
        ]);

        $this->from(route('eateries.show', $eatery))
            ->post(route('eateries.reviews.store', $eatery), [
                'rating' => 6,
                'body' => 'short',
            ])
            ->assertSessionHasErrors([
                'user_id' => 'Choose who is writing this review.',
                'rating' => 'Ratings go from 1 to 5 stars only.',
                'body' => 'Kaon Ta Regalado: reviews need at least 10 characters.',
            ]);
    }

    public function test_updating_without_changes_ignores_own_unique_records(): void
    {
        $district = District::create(['name' => 'Poblacion']);
        $feature = Feature::create(['name' => 'Budget Meal']);
        $eatery = Eatery::create([
            'district_id' => $district->id,
            'name' => 'Carinderia ni Regalado',
            'slug' => 'carinderia-ni-regalado',
            'address' => 'San Pedro St., Poblacion, Davao City',
            'price_range' => 'budget',
            'specialty' => 'Tinolang Manok',
            'is_open' => true,
        ]);
        Permit::create([
            'eatery_id' => $eatery->id,
            'permit_no' => 'DVO-2026-1203',
            'expires_on' => '2027-12-03',
        ]);
        $eatery->features()->attach($feature->id);

        $response = $this->put(route('eateries.update', $eatery), [
            'name' => 'Carinderia ni Regalado',
            'district_id' => $district->id,
            'address' => 'San Pedro St., Poblacion, Davao City',
            'price_range' => 'budget',
            'specialty' => 'Tinolang Manok',
            'is_open' => '1',
            'features' => [$feature->id],
            'permit_no' => 'DVO-2026-1203',
            'expires_on' => '2027-12-03',
        ]);

        $response->assertRedirect(route('eateries.show', $eatery));
        $response->assertSessionHasNoErrors();
    }
}
