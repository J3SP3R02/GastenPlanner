<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //Schema::dropIfExists('guestlists');
        Schema::create('guestlists', function (Blueprint $table) {
            $table->id();

            $table->string('moment_welcome_1')->nullable();
            $table->string('moment_welcome_2')->nullable();
            $table->string('moment_welcome_3')->nullable();
            $table->string('moment_welcome_4')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guestlists');
    }
};
