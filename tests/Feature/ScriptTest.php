<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Wedding;
use Database\Factories\WeddingFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ScriptTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_user_can_view_script()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $guestlist = \App\Models\Guestlist::factory()->create();
        \App\Models\Script::factory()->create();
        
        $wedding = \App\Models\Wedding::factory()->create([
            'user_id' => $user->id, // Associate the user with the wedding
            'guestlist_id' => $guestlist->id,

        ]);

        $response = $this->get("/bruiloft/{$wedding->unique_code}/draaiboek");
        $response->assertStatus(200);
        $response->assertViewIs('script.index');
    }

    public function test_user_cannot_view_script_without_auth()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
        $guestlist = \App\Models\Guestlist::factory()->create();
        
        \App\Models\Script::factory()->create();
        $wedding = \App\Models\Wedding::factory()->create([
            'user_id' => $user->id, // Associate the user with the wedding
            'guestlist_id' => $guestlist->id,

        ]);

        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $response = $this->get("/bruiloft/{$wedding->unique_code}/draaiboek");
        $response->assertRedirect('/');
    }

    public function test_user_can_create_script_with_details()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $guestlist = \App\Models\Guestlist::factory()->create();
        $wedding = \App\Models\Wedding::factory()->create([
            'user_id' => $user->id, // Associate the user with the wedding
            'guestlist_id' => $guestlist->id,
        ]);

        $scriptDetails = [
            'activity' => $this->faker->sentence(),
            'starttime' => $this->faker->time(),
            'endtime' => $this->faker->time(),
            'location'=> $this->faker->address(),
            'attendees'=> $this->faker->randomNumber(2),
        ];
        $this->post("/bruiloft/{$wedding->unique_code}/draaiboek", $scriptDetails);
        $this->assertDatabaseHas('scripts', $scriptDetails);
    }
    
    public function test_user_cannot_create_script_without_details()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $guestlist = \App\Models\Guestlist::factory()->create();
        $wedding = \App\Models\Wedding::factory()->create([
            'user_id' => $user->id, // Associate the user with the wedding
            'guestlist_id' => $guestlist->id,
        ]);

        $scriptDetails = [
            'activity' => '',
            'starttime' => '',
            'endtime' => '',
            'location'=> '',
            'attendees'=>'',
        ];
        $response= $this->post("/bruiloft/{$wedding->unique_code}/draaiboek", $scriptDetails);
        $response->assertSessionHasErrors(['activity', 'starttime', 'endtime', 'location', 'attendees']);
    }
    
}
