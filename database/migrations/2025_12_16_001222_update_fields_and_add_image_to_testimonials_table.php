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
        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->string('role')->nullable()->change();
            $table->string('location')->nullable()->change();
            $table->text('content')->nullable()->change();
            $table->string('image')->nullable()->after('content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            // 1. Mengembalikan kolom existing menjadi NOT NULL (sesuai migrasi awal)
            $table->string('name')->nullable(false)->change();
            $table->string('role')->nullable(false)->change();
            $table->string('location')->nullable(false)->change();
            $table->text('content')->nullable(false)->change();
            
            // 2. Menghapus kolom 'image'
            $table->dropColumn('image');
        });
    }
};