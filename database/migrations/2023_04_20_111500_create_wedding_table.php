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
        Schema::dropIfExists('weddings');
        Schema::create('weddings', function (Blueprint $table) {
            $table->id();
            $table->string('unique_code');
            $table->string('title')->default('');
            $table->string('date')->default('');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('guestlist_id');
            $table->foreign('guestlist_id')->references('id')->on('guestlists')->onDelete('cascade');
            //location_id
            //music_id
            //seating_id
            //script_id
            //cadeautips_id
            //planning_id
            //billist_id
            //budget_id
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wedding');
    }
};
