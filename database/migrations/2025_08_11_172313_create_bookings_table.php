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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('booking_id');
            $table->unsignedBigInteger('destination_id')->nullable();
            $table->string('destination_name')->nullable();
            $table->date('travel_date');
            $table->integer('duration_nights')->nullable();
            $table->string('package_type')->default('regular');

            // Informasi Pengguna
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email');
            $table->string('country');
            $table->text('message')->nullable();

            // Custom Fields (nullable)
            $table->json('interests')->nullable();
            $table->integer('travelers')->default(1);
            $table->string('budget_range')->nullable();
            $table->string('custom_destinations')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
