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
        Schema::create('cars', function (Blueprint $table) {
            $table->id('car_id');
            $table->string('name_car');
            $table->string('slug')->unique();
            $table->string('image_car_1');
            $table->string('image_car_2')->nullable();
            $table->string('image_car_3')->nullable();
            $table->text('description');
            $table->string('car_type')->nullable();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->integer('capacity');
            $table->string('transmission');
            $table->string('car_status')->default('available');
            $table->boolean('rental_type')->default(false);
            $table->text('include')->nullable();
            $table->text('additional')->nullable();
            $table->text('notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
