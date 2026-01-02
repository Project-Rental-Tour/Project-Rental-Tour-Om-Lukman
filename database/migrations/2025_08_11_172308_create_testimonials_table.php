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
        Schema::create('testimonials', function (Blueprint $table) {
            // Primary Key (Sesuai file create awal)
            $table->id('testimonial_id');

            // Data Testimoni (Dibuat nullable sesuai file update terakhir)
            $table->string('name')->nullable();
            $table->string('role')->nullable();
            $table->string('location')->nullable();
            $table->text('content')->nullable();
            
            // Kolom Gambar (Tambahan dari file update)
            $table->string('image')->nullable();

            // Rating & Timestamps
            $table->integer('rating')->default(5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};