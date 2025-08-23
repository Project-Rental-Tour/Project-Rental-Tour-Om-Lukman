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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id('profile_id');
            $table->string('website_name')->nullable();
            $table->string('website_logo_light')->nullable();
            $table->string('website_logo_dark')->nullable(); // simpan path logo
            $table->string('jumbotron_heading')->nullable();
            $table->text('jumbotron_subheading')->nullable();
            $table->string('jumbotron_image')->nullable(); // path gambar jumbotron
            $table->string('about_heading')->nullable();
            $table->text('about_description')->nullable();
            $table->text('address')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('operating_hours')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
