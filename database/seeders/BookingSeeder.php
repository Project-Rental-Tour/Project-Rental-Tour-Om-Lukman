<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bookings')->insert([
            [
                'destination_id' => 1,
                'destination_name' => 'Bali Adventure Tour 3D2N',
                'travel_date' => '2025-06-15',
                'duration_nights' => 2,
                'package_type' => 'regular',
                'first_name' => 'Andi',
                'last_name' => 'Wijaya',
                'email' => 'andi.wijaya@example.com',
                'country' => 'Indonesia',
                'message' => 'Saya ingin tambahkan snorkeling jika memungkinkan.',
                'interests' => json_encode(['Adventure', 'Nature']),
                'travelers' => 2,
                'budget_range' => '2000000-3000000',
                'custom_destinations' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'destination_id' => 2,
                'destination_name' => 'Lombok Beach Getaway 4D3N',
                'travel_date' => '2025-07-20',
                'duration_nights' => 3,
                'package_type' => 'premium',
                'first_name' => 'Siti',
                'last_name' => 'Rahayu',
                'email' => 'siti.rahayu@example.com',
                'country' => 'Malaysia',
                'message' => 'Butuh antar-jemput dari bandara pagi hari.',
                'interests' => json_encode(['Relaxation', 'Beach']),
                'travelers' => 1,
                'budget_range' => '3000000-4000000',
                'custom_destinations' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'destination_id' => null,
                'destination_name' => null,
                'travel_date' => '2025-08-10',
                'duration_nights' => 5,
                'package_type' => 'custom',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john.doe@example.com',
                'country' => 'United States',
                'message' => 'Looking for a custom trekking + cultural tour in Java and Bali.',
                'interests' => json_encode(['Trekking', 'Culture', 'Photography']),
                'travelers' => 4,
                'budget_range' => '8000000-10000000',
                'custom_destinations' => 'Yogyakarta, Mount Bromo, Ubud',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
