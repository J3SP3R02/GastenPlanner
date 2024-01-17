<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_user_can_register_with_valid_credentials()
    {
        $password = $this->faker->password(8);
        $userData = [
            'firstname' => $this->faker->firstname,
            'lastname' => $this->faker->lastname,
            'email' => $this->faker->unique()->safeEmail,
            'phoneNumber' => $this->faker->phoneNumber(),
            'password' => $password,
            'password_confirmation' => $password,
        ];

        $response = $this->post('/registreren', $userData);

        $response->assertRedirect('/');
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => $userData['email'],
        ]);
    }

    public function test_user_cannot_register_with_invalid_credentials()
    {
        $response = $this->post('/registreren', []);

        $response->assertSessionHasErrors(['firstname', 'lastname', 'email', 'phoneNumber', 'password']);
        $this->assertGuest();
    }
}
