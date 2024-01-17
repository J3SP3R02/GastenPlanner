<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Wedding;
use Database\Factories\WeddingFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ManagementTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_admin_can_view_usermanagement(){
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $guestlist = \App\Models\Guestlist::factory()->create();
        \App\Models\Wedding::factory()->create([
            'user_id' => $user->id, // Associate the user with the wedding
            'guestlist_id' => $guestlist->id,

        ]);

        $response = $this->get("/management");
        $response->assertStatus(200);
        $response->assertViewIs('userManagement.index');
    }
}