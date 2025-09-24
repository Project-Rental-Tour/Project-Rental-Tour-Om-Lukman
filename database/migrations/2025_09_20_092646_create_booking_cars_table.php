<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking_cars', function (Blueprint $table) {
            $table->id('booking_cars_id');
            $table->foreignId('car_id')->constrained('cars', 'car_id')->onDelete('cascade');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_email')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('duration_days')->virtualAs('DATEDIFF(end_date, start_date)');
            $table->decimal('total_price', 12, 2);
            $table->boolean('rental_type')->default(false);
            $table->string('booking_status')->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_cars');
    }
};
