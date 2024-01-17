<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Wedding;
use Database\Factories\WeddingFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LocationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_user_can_view_locations()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $guestlist = \App\Models\Guestlist::factory()->create();
        $wedding = \App\Models\Wedding::factory()->create([
            'user_id' => $user->id, // Associate the user with the wedding
            'guestlist_id' => $guestlist->id,

        ]);

        \App\Models\Location::factory()->create([
            'wedding_id' => $wedding->id,
        ]);

        $response = $this->get("/bruiloft/{$wedding->unique_code}/locatie");
        $response->assertStatus(200);
        $response->assertViewIs('location.index');
    }

    public function test_user_cannot_view_locations()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $guestlist = \App\Models\Guestlist::factory()->create();
        $wedding = \App\Models\Wedding::factory()->create([
            'user_id' => $user->id, // Associate the user with the wedding
            'guestlist_id' => $guestlist->id,

        ]);

        \App\Models\Location::factory()->create([
            'wedding_id' => $wedding->id,
        ]);

        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $response = $this->get("/bruiloft/{$wedding->unique_code}/locatie");
        $response->assertRedirect('/');
    }

    public function test_user_can_create_locations()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $guestlist = \App\Models\Guestlist::factory()->create();
        $wedding = \App\Models\Wedding::factory()->create([
            'user_id' => $user->id, // Associate the user with the wedding
            'guestlist_id' => $guestlist->id,

        ]);

        $locationDetails = [
            'address_address' =>  $this->faker->address(),
            'address_longitude' =>  $this->faker->longitude(),
            'address_latitude' =>  $this->faker->latitude(),
        ];
        $this->post("/bruiloft/{$wedding->unique_code}/locatie", $locationDetails);
        $this->assertDatabaseHas('locations', $locationDetails);
    }
    
    public function test_user_cannot_create_locations_without_details()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $guestlist = \App\Models\Guestlist::factory()->create();
        $wedding = \App\Models\Wedding::factory()->create([
            'user_id' => $user->id, // Associate the user with the wedding
            'guestlist_id' => $guestlist->id,

        ]);

        $locationDetails = [
            'address_address' =>  '',
            'address_longitude' =>  '',
            'address_latitude' =>  '',
        ];
        $response= $this->post("/bruiloft/{$wedding->unique_code}/locatie", $locationDetails);
        $response->assertSessionHasErrors(['address_address', 'address_longitude', 'address_latitude']);
    }
}
