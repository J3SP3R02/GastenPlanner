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
        Schema::dropIfExists('guests');
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('phoneNumber');
            $table->string('password')->nullable();
            $table->string('dietary_wishes')->nullable();
            $table->string('allergies')->nullable();

            $table->boolean('moment_welcome_1')->default(false);
            $table->boolean('moment_welcome_2')->default(false);
            $table->boolean('moment_welcome_3')->default(false);
            $table->boolean('moment_welcome_4')->default(false);

            $table->unsignedBigInteger('guestlist_id');
            $table->foreign('guestlist_id')->references('id')->on('guestlists')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
