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
            // Primary Key
            $table->id('destination_id');

            // Basic Information
            $table->string('name_package'); // Pastikan ini String (Bukan JSON)
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('type_destination')->nullable();
            $table->string('place');

            // Pricing Section
            $table->decimal('price', 10, 2)->default('0.00')->nullable(); // Harga Dasar / WNI
            $table->decimal('discount_price', 10, 2)->default('0.00')->nullable();
            $table->decimal('price_2', 10, 2)->default('0.00')->nullable(); // Harga WNA / Tambahan
            $table->json('price_tiers')->nullable(); // Kolom JSON untuk harga bertingkat

            // Photos (Main + Extra)
            $table->string('destination_photo')->nullable();
            $table->string('destination_photo_2')->nullable();
            $table->string('destination_photo_3')->nullable();
            $table->string('destination_photo_4')->nullable();

            // Destination Details
            $table->string('time'); // Duration
            $table->string('category')->nullable();
            $table->string('level')->nullable();
            
            // Logistics & Facilities
            $table->string('pickup_points')->nullable(); // Bisa diganti text jika isinya panjang
            $table->string('dropoff_points')->nullable(); // Bisa diganti text jika isinya panjang
            $table->string('transportation')->nullable();
            $table->string('accommodation')->nullable();
            $table->string('consumption')->nullable();

            // Activities & Inclusions
            $table->text('activities')->nullable();
            $table->text('include')->nullable();
            $table->text('exclude')->nullable();
            
            // Policies & Notes
            $table->string('wna_wni_policy')->nullable();
            $table->longText('itinerary')->nullable();
            $table->text('note')->nullable();
            $table->string('tag')->nullable();

            // Timestamps (created_at, updated_at)
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