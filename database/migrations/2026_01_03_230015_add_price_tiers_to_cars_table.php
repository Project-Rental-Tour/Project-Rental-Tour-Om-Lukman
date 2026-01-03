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
        Schema::table('cars', function (Blueprint $table) {
            // Kita gunakan tipe JSON agar bisa menyimpan array harga (misal: 12 jam, 24 jam, mingguan)
            // 'after' digunakan agar posisi kolom rapi di database (setelah kolom price)
            $table->json('price_tiers')->nullable()->after('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('price_tiers');
        });
    }
};