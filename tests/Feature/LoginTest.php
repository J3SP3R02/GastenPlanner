<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;
use Faker\Factory as Faker;

class LoginTest extends TestCase
{
use RefreshDatabase, WithFaker;

public function test_user_can_login_with_valid_credentials()
{
    $user = User::factory()->create([
        'email' => 'u@example.com',
        'password' => bcrypt('password'),
    ]);

    $response = $this->post('/login', [
        'email' => 'u@example.com',
        'password' => 'password',
    ]);

    $response->assertRedirect('/');
    $this->assertAuthenticatedAs($user);

}

public function test_user_cannot_login_with_invalid_credentials()
{
    $user = User::factory()->create([
        'email' => 'user@example.com',
        'password' => bcrypt('password'),
    ]);

    $response = $this->post('/login', [
        'email' => 'user@example.com',
        'password' => 'wrongpassword',
    ]);

    $response->assertSessionHasErrors();
    $this->assertGuest();
}

}
