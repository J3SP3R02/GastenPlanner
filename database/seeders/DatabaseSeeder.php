<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Wedding;
use App\Models\WelcomeRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

         \App\Models\User::factory(1)->create();
         \App\Models\Guestlist::factory(1)->create();
         \App\Models\Guest::factory(10)->create();
         \App\Models\Wedding::factory(1)->create();
    }
}

