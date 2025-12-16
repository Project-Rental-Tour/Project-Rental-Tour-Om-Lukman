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
        Schema::table('destinations', function (Blueprint $table) {
            $table->decimal('price_2', 10, 2)->default('0.00')->nullable()->after('discount_price'); 
            $table->string('destination_photo_2')->nullable()->after('destination_photo');
            $table->string('destination_photo_3')->nullable()->after('destination_photo_2');
            $table->string('destination_photo_4')->nullable()->after('destination_photo_3');
            $table->string('wna_wni_policy')->nullable()->after('exclude'); 
            // Atau jika Anda mau menambahkan harga WNI (sekarang price) dan harga WNA (price_2)
            
        });
    }

    /**
     * Reverse the migrations (PENTING untuk rollback)
     */
    public function down(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn([
                'price_2', 
                'destination_photo_2', 
                'destination_photo_3', 
                'destination_photo_4',
                'wna_wni_policy'
            ]);
        });
    }
};