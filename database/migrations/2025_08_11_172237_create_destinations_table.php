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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id('destination_id');
            $table->string('name_package');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('place');
            $table->decimal('price', 10, 2)->default('0.00')->nullable();
            $table->string('destination_photo')->nullable();
            $table->string('time');
            $table->string('category')->nullable();
            $table->string('level')->nullable();
            $table->string('pickup_points')->nullable();
            $table->string('dropoff_points')->nullable();
            $table->text('activities')->nullable();
            $table->string('transportation')->nullable();
            $table->string('accommodation')->nullable();
            $table->string('consumption')->nullable();
            $table->text('include')->nullable();
            $table->text('exclude')->nullable();
            $table->longText('itinerary')->nullable();
            $table->string('tag')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
