<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Destination;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Destination::create([
            'name_package' => 'Bali Adventure Tour 3D2N',
            'slug' => 'bali-adventure-tour-3d2n',
            'place' => 'Bali',
            'price' => 2500000.00,
            'destination_photo' => 'bali.jpg',
            'time' => '3 Days 2 Nights',
            'category' => 'Adventure',
            'level' => 'Medium',
            'pickup_points' => json_encode(['Denpasar Airport', 'Kuta Area']),
            'dropoff_points' => json_encode(['Denpasar Airport']),
            'activities' => 'Rafting, Trekking, Sunset View',
            'transportation' => 'Private Car',
            'accommodation' => '3-Star Hotel',
            'consumption' => 'Breakfast, Lunch',
            'include' => 'Guide, Entrance Fees, Equipment',
            'exclude' => 'Personal Expenses, Tips',
            'itinerary' => 'Day 1: Arrival & Kuta Tour | Day 2: Ubud Adventure & Rafting | Day 3: Departure',
        ]);

        Destination::create([
            'name_package' => 'Lombok Beach Getaway 4D3N',
            'slug' => 'lombok-beach-getaway-4d3n',
            'place' => 'Lombok',
            'price' => 3200000.00,
            'destination_photo' => 'lombok.jpg',
            'time' => '4 Days 3 Nights',
            'category' => 'Relaxation',
            'level' => 'Easy',
            'pickup_points' => json_encode(['Lombok Airport']),
            'dropoff_points' => json_encode(['Lombok Airport']),
            'activities' => 'Beach Hopping, Snorkeling',
            'transportation' => 'Minibus',
            'accommodation' => 'Beach Resort',
            'consumption' => 'All Meals',
            'include' => 'Snorkeling Gear, Island Hopping Trip',
            'exclude' => 'Flight Tickets, Spa Services',
            'itinerary' => 'Day 1: Arrival & Relax | Day 2: Gili Islands Tour | Day 3: Waterfall & Beach | Day 4: Departure',
        ]);

        Destination::create([
            'name_package' => 'Mount Rinjani Trekking 5D4N',
            'slug' => 'mount-rinjani-trekking-5d4n',
            'place' => 'Lombok',
            'price' => 5500000.00,
            'destination_photo' => 'rinjani.jpg',
            'time' => '5 Days 4 Nights',
            'category' => 'Trekking',
            'level' => 'Hard',
            'pickup_points' => json_encode(['Senaru Village']),
            'dropoff_points' => json_encode(['Senaru Village']),
            'activities' => 'High Altitude Trekking, Camping, Sunrise View',
            'transportation' => '4WD & Porter Support',
            'accommodation' => 'Camping',
            'consumption' => 'All Meals During Trek',
            'include' => 'Guide, Porter, Camping Equipment',
            'exclude' => 'Personal Gear, Flight',
            'itinerary' => 'Day 1: Base Camp | Day 2: Summit Attempt & Crater | Day 3: Descent to Shelter | Day 4: Exit & Relax | Day 5: Departure',
        ]);
    }
}
