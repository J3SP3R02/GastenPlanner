<?php

namespace Tests\Feature;

use App\Http\Controllers\GuestController;
use App\Models\Guestlist;
use App\Models\User;
use App\Models\Wedding;
use Database\Factories\GuestlistFactory;
use Database\Factories\WeddingFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class GuestlistTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_user_can_view_guestlist()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $guestlist = \App\Models\Guestlist::factory()->create();
        $wedding = \App\Models\Wedding::factory()->create([
            'user_id' => $user->id, // Associate the user with the wedding
            'guestlist_id' => $guestlist->id,
        ]);

        $response = $this->get("/bruiloft/{$wedding->unique_code}/gastenlijst");
        $response->assertStatus(200);
        $response->assertViewIs('guestlist.index');
    }
    public function test_user_cannot_view_guestlist_without_auth()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $guestlist = \App\Models\Guestlist::factory()->create();
        $wedding = \App\Models\Wedding::factory()->create([
            'user_id' => $user->id, // Associate the user with the wedding
            'guestlist_id' => $guestlist->id,
        ]);
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $response = $this->get("/bruiloft/{$wedding->unique_code}/gastenlijst");
        $response->assertRedirect('/');
    }


    public function test_user_can_create_guests_with_details()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $guestlist = \App\Models\Guestlist::factory()->create();
        $wedding = \App\Models\Wedding::factory()->create([
            'user_id' => $user->id, // Associate the user with the wedding
            'guestlist_id' => $guestlist->id,
        ]);

        $guestDetails = [
            'firstname' => $this->faker->firstname,
            'lastname' => $this->faker->lastname,
            'email' => $this->faker->unique()->safeEmail,
            'phoneNumber' => $this->faker->phoneNumber(),
            'guestlist_id' => $guestlist->id,
        ];
        $this->post("/bruiloft/{$wedding->unique_code}/gastenlijst", $guestDetails);
        $this->assertDatabaseHas('guests', $guestDetails);
    }

    public function test_user_cannot_create_guests_without_details()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $guestlist = \App\Models\Guestlist::factory()->create();
        $wedding = \App\Models\Wedding::factory()->create([
            'user_id' => $user->id, // Associate the user with the wedding
            'guestlist_id' => $guestlist->id,
        ]);

        $guestDetails = [
            'firstname' => '',
            'lastname' => '',
            'email' => '',
            'phoneNumber' => '',
            'guestlist_id' => $guestlist->id,
        ];
        $response = $this->post("/bruiloft/{$wedding->unique_code}/gastenlijst", $guestDetails);
        $response->assertSessionHasErrors(['firstname', 'lastname', 'email', 'phoneNumber']);
    }

    public function test_user_cannot_create_guests_with_invalid_email()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $guestlist = \App\Models\Guestlist::factory()->create();
        $wedding = \App\Models\Wedding::factory()->create([
            'user_id' => $user->id, // Associate the user with the wedding
            'guestlist_id' => $guestlist->id,
        ]);

        $guestDetails = [
            'firstname' => $this->faker->firstname,
            'lastname' => $this->faker->lastname,
            'email' => '',
            'phoneNumber' => $this->faker->phoneNumber(),
            'guestlist_id' => $guestlist->id,
        ];
        $response = $this->post("/bruiloft/{$wedding->unique_code}/gastenlijst", $guestDetails);
        $response->assertSessionHasErrors(['email']);
    }

    public function test_user_can_update_guests_with_details()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $guestlist = \App\Models\Guestlist::factory()->create();
        $wedding = \App\Models\Wedding::factory()->create([
            'user_id' => $user->id,
            'guestlist_id' => $guestlist->id,
        ]);

        // Create a guest
        $guest = \App\Models\Guest::factory()->create([
            'guestlist_id' => $guestlist->id,
        ]);

        // Define the updated guest details
        $updatedGuestDetails = [
            'id' => $guest->id,
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'phoneNumber' => $this->faker->phoneNumber,
            'dietary_wishes' => 'No dairy',
            'allergies' => 'Peanuts',
        ];

        // Send a PUT request to update the guest information
        $this->put("/bruiloft/{$wedding->unique_code}/gastenlijst/", $updatedGuestDetails);

        // Assert that the guest details were updated in the database
        $this->assertDatabaseHas('guests', $updatedGuestDetails);
    }
    public function test_user_cannot_update_guests_without_details()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $guestlist = \App\Models\Guestlist::factory()->create();
        $wedding = \App\Models\Wedding::factory()->create([
            'user_id' => $user->id,
            'guestlist_id' => $guestlist->id,
        ]);

        // Create a guest
        $guest = \App\Models\Guest::factory()->create([
            'guestlist_id' => $guestlist->id,
        ]);

        // Define the updated guest details
        $updatedGuestDetails = [
            'id' => $guest->id,
        ];

        // Send a PUT request to update the guest information
        $response = $this->put("/bruiloft/{$wedding->unique_code}/gastenlijst/", $updatedGuestDetails);

        // Assert that the guest details were updated in the database
        $this->assertDatabaseHas('guests', $updatedGuestDetails);
        $response->assertSessionHasErrors(['firstname', 'lastname', 'email', 'phoneNumber']);
    }
    public function test_user_can_destroy_guest()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $guestlist = \App\Models\Guestlist::factory()->create();
        $wedding = \App\Models\Wedding::factory()->create([
            'user_id' => $user->id,
            'guestlist_id' => $guestlist->id,
        ]);

        // Create a guest
        $guest = \App\Models\Guest::factory()->create([
            'guestlist_id' => $guestlist->id,
        ]);
        $guestid = [
            'id' => $guest->id,
        ];
        // Send a DELETE request to delete the guest information
        $this->delete("/bruiloft/{$wedding->unique_code}/gastenlijst", $guestid);

        // Assert that the guest details where deleted in the database
        $this->assertDatabaseMissing('guests', ['id' => $guest->id]);
    }
    public function test_guestlist_export()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $guestlist = \App\Models\Guestlist::factory()->create();
        $wedding = \App\Models\Wedding::factory()->create([
            'user_id' => $user->id,
            'guestlist_id' => $guestlist->id,
        ]);

        // Create some guests associated with the guestlist
        \App\Models\Guest::factory()->count(10)->create([
            'guestlist_id' => $guestlist->id,
        ]);

        // Send a GET request to export the guestlist
        $response = $this->get("/bruiloft/{$wedding->unique_code}/gastenlijst/export");

        // Assert that the response is successful
        $response->assertOk();

        // Assert that the response is a downloadable file
        $response->assertHeader('Content-Disposition', 'attachment; filename=gastenlijst.xlsx');
    }
    public function test_user_can_set_welcome_moments()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $guestlist = \App\Models\Guestlist::factory()->create();
        $wedding = \App\Models\Wedding::factory()->create([
            'user_id' => $user->id,
            'guestlist_id' => $guestlist->id,
        ]);
        $moments = [
            'moment_welcome_1' => 'Ochtend',
            'moment_welcome_2' => 'Middag',
            'moment_welcome_3' => 'Avond',
            'moment_welcome_4' => 'Nacht',
        ];
        $response = $this->put("/bruiloft/{$wedding->unique_code}/gastenlijst/welcome_role", $moments);
        $response->assertRedirect("");
        $response->assertSessionHasNoErrors();

        $updatedGuestlist = Guestlist::find($guestlist->id);

        // Assert that the send data equals to the data in the guestlist
        $this->assertEquals($moments['moment_welcome_1'], $updatedGuestlist->moment_welcome_1);
        $this->assertEquals($moments['moment_welcome_2'], $updatedGuestlist->moment_welcome_2);
        $this->assertEquals($moments['moment_welcome_3'], $updatedGuestlist->moment_welcome_3);
        $this->assertEquals($moments['moment_welcome_4'], $updatedGuestlist->moment_welcome_4);
    }
}
