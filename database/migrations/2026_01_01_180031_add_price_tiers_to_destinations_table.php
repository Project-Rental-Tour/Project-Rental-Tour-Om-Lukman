<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            // 1. Tambahkan kolom price_tiers tipe JSON (jika belum ada)
            if (!Schema::hasColumn('destinations', 'price_tiers')) {
                $table->json('price_tiers')->nullable()->after('price_2');
            }

            // 2. SAFETY FIX: Pastikan name_package adalah STRING (VARCHAR), bukan JSON
            // Ini untuk memperbaiki error "Invalid JSON text... in column name_package"
            $table->string('name_package', 255)->change();
        });
    }

    public function down(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            if (Schema::hasColumn('destinations', 'price_tiers')) {
                $table->dropColumn('price_tiers');
            }
        });
    }
};