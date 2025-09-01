<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimoniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Samuel Baker',
                'role' => 'Architect',
                'location' => 'Warsaw, Poland',
                'content' => 'I appreciated the architectural tours, which were very detailed. The only minor issue was one delayed bus ride, but it didn’t affect the overall experience.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Chloe Adams',
                'role' => 'Blogger',
                'location' => 'Manila, Philippines',
                'content' => 'This trip gave me so much content for my blog! The destinations were beautiful, and the stories behind them were fascinating. The guides made it all so engaging.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ahmad Susanto',
                'role' => 'Business Owner',
                'location' => 'Jakarta, Indonesia',
                'content' => 'I’ve joined several tours before, but this one was the smoothest. The airport transfers, hotel check-ins, and even meals were seamless. I didn’t have to worry about anything.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ella Walker',
                'role' => 'Researcher',
                'location' => 'Zurich, Switzerland',
                'content' => 'Everything was educational as well as enjoyable. The guides were excellent at explaining the history and culture behind each site. It felt like traveling and learning at the same time.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Grace King',
                'role' => 'Writer',
                'location' => 'Seoul, South Korea',
                'content' => 'I enjoyed writing my travel journal during this trip because each day was filled with stories. The landscapes, the culture, and the people made it unforgettable.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Lucas Young',
                'role' => 'Tour Guide',
                'location' => 'Cape Town, South Africa',
                'content' => 'Even as a tour guide myself, I was blown away by how well this company handled everything. The attention to detail and hospitality were world-class.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Lily Scott',
                'role' => 'Doctor',
                'location' => 'Kuala Lumpur, Malaysia',
                'content' => 'As someone who doesn’t usually travel, I was impressed by how stress-free the whole process was. Everything was handled with professionalism and care.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Henry Allen',
                'role' => 'Artist',
                'location' => 'Amsterdam, Netherlands',
                'content' => 'I loved the artistic side of this journey – from architecture to traditional crafts. It gave me a lot of inspiration for my own work.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Charlotte Hall',
                'role' => 'Freelancer',
                'location' => 'Dubai, UAE',
                'content' => 'The hotels were excellent, and the bus was very comfortable. I just wish we had a bit more time at some of the landmarks. Overall, though, a great experience.',
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Benjamin Lewis',
                'role' => 'Musician',
                'location' => 'Chicago, USA',
                'content' => 'Traveling as a group of friends, we had so much fun. The night tours and cultural shows were the highlights. We felt immersed in the local lifestyle.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // 40 Additional English Testimonials
            [
                'name' => 'Ahmad Rizki',
                'role' => 'Travel Blogger',
                'location' => 'Jakarta, Indonesia',
                'content' => 'An amazing journey from start to finish! The team was professional, the destinations were breathtaking, and every moment felt well-planned.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Sarah Wijaya',
                'role' => 'Photographer',
                'location' => 'Bandung, Indonesia',
                'content' => 'As a photographer, I was in paradise. The scenery was stunning, lighting was perfect, and every location offered unique photo opportunities.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Budi Santoso',
                'role' => 'Businessman',
                'location' => 'Surabaya, Indonesia',
                'content' => 'A highly efficient business trip. Everything was scheduled perfectly, allowing me to focus on meetings without worrying about logistics.',
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Lisa Anderson',
                'role' => 'Teacher',
                'location' => 'New York, USA',
                'content' => 'I brought my students on an educational tour, and everything went smoothly. They learned so much and had a wonderful time.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Kenji Tanaka',
                'role' => 'Tourist',
                'location' => 'Tokyo, Japan',
                'content' => 'A culturally rich experience. The guides were knowledgeable and helped me understand local traditions in a meaningful way.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Maria Garcia',
                'role' => 'Student',
                'location' => 'Madrid, Spain',
                'content' => 'Perfect for students on a budget. Great value for money, clean accommodations, and unforgettable adventures.',
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Robert Johnson',
                'role' => 'Retiree',
                'location' => 'London, UK',
                'content' => 'As a retiree, I appreciated the relaxed pace. Everything was well-organized, and the staff was incredibly helpful.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Chen Wei',
                'role' => 'Entrepreneur',
                'location' => 'Beijing, China',
                'content' => 'Impressed by the professionalism of the team. They responded quickly to requests and provided excellent solutions.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Amanda Lee',
                'role' => 'Food Vlogger',
                'location' => 'Singapore',
                'content' => 'The food experiences were incredible—authentic street food to fine dining. Every meal was a celebration of local flavors.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'David Muller',
                'role' => 'Engineer',
                'location' => 'Berlin, Germany',
                'content' => 'Everything ran on time, and the transportation was comfortable. As someone who values efficiency, I truly appreciated it.',
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Nina Patel',
                'role' => 'Doctor',
                'location' => 'Mumbai, India',
                'content' => 'After months of stressful work, this trip was a breath of fresh air. Peaceful locations and healing energy everywhere.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Michael Brown',
                'role' => 'Freelancer',
                'location' => 'Sydney, Australia',
                'content' => 'I could work remotely with ease. Fast internet and quiet spaces made it possible to balance productivity and adventure.',
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Sophie Martin',
                'role' => 'Artist',
                'location' => 'Paris, France',
                'content' => 'The colors, textures, and cultural details were pure inspiration. I returned home with a sketchbook full of new ideas.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'James Wilson',
                'role' => 'Writer',
                'location' => 'Toronto, Canada',
                'content' => 'Every day brought a new story. The locals were warm and shared personal tales that enriched my writing.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Elena Rossi',
                'role' => 'Architect',
                'location' => 'Rome, Italy',
                'content' => 'The local architecture was breathtaking. I learned so much about traditional building techniques and urban design.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Thomas Kim',
                'role' => 'Digital Nomad',
                'location' => 'Seoul, South Korea',
                'content' => 'Perfect balance between work and adventure. Accommodations were comfortable with great amenities for remote work.',
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Olivia Davis',
                'role' => 'Yoga Instructor',
                'location' => 'Bali, Indonesia',
                'content' => 'An ideal place for meditation and self-reflection. The natural surroundings radiate peace and positive energy.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'William Taylor',
                'role' => 'Historian',
                'location' => 'Cambridge, UK',
                'content' => 'Rich in historical and cultural depth. The guides were extremely knowledgeable and answered all my detailed questions.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Aisha Mohammed',
                'role' => 'Environmentalist',
                'location' => 'Cape Town, South Africa',
                'content' => 'I appreciate the commitment to sustainable tourism. They truly care about the environment and local communities.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Daniel White',
                'role' => 'Adventure Seeker',
                'location' => 'Queenstown, New Zealand',
                'content' => 'Thrilling activities with excellent safety standards. As an adrenaline lover, I couldn’t have asked for more.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Maya Singh',
                'role' => 'Family Traveler',
                'location' => 'New Delhi, India',
                'content' => 'Family-friendly tour with activities for all ages. My kids had a blast, and I felt completely at ease.',
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ryan Clark',
                'role' => 'Solo Traveler',
                'location' => 'Vancouver, Canada',
                'content' => 'As a solo traveler, I felt safe and welcomed. I met amazing people and created unforgettable memories.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Emma Wright',
                'role' => 'Honeymooner',
                'location' => 'Maldives',
                'content' => 'The perfect honeymoon! Romantic atmosphere, excellent privacy, and personalized service made it magical.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Lucas Garcia',
                'role' => 'Diver',
                'location' => 'Cairns, Australia',
                'content' => 'Incredible dive spots! The coral reefs are vibrant, and marine life is diverse and well-protected.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Chloe Robinson',
                'role' => 'Wildlife Photographer',
                'location' => 'Nairobi, Kenya',
                'content' => 'Fantastic opportunity to photograph wildlife in their natural habitat. The guides respected nature and kept a safe distance.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Noah Allen',
                'role' => 'Backpacker',
                'location' => 'Bangkok, Thailand',
                'content' => 'Great value for money. Clean hostels, easy transport, and delicious food at affordable prices.',
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Isabella King',
                'role' => 'Luxury Traveler',
                'location' => 'Dubai, UAE',
                'content' => 'A luxurious experience worth every penny. Premium facilities, exceptional service, and flawless attention to detail.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Benjamin Green',
                'role' => 'Cultural Researcher',
                'location' => 'Kyoto, Japan',
                'content' => 'Authentic access to local communities and traditions. I learned directly from locals about their heritage.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Charlotte Scott',
                'role' => 'Festival Goer',
                'location' => 'Rio de Janeiro, Brazil',
                'content' => 'Perfect timing to experience the cultural festival. The energy of the people was contagious and exhilarating.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Henry Adams',
                'role' => 'Food Enthusiast',
                'location' => 'Mexico City, Mexico',
                'content' => 'An outstanding culinary tour! From street tacos to gourmet dishes, every bite was a flavor explosion.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Fiona Patel',
                'role' => 'Fashion Designer',
                'location' => 'Mumbai, India',
                'content' => 'Traditional patterns and textiles inspired me deeply. I discovered new textures and cultural motifs for my next collection.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Julian Moore',
                'role' => 'University Student',
                'location' => 'Melbourne, Australia',
                'content' => 'This trip opened my eyes to the world. I made friends from different cultures and gained unforgettable experiences.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Anita Lim',
                'role' => 'Chef',
                'location' => 'Hong Kong',
                'content' => 'Learning traditional cooking techniques from local chefs was invaluable. A dream come true for any culinary professional.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mateo Cruz',
                'role' => 'Musician',
                'location' => 'Barcelona, Spain',
                'content' => 'Street music and live performances were inspiring. I even collaborated with local artists—what an experience!',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Zara Khan',
                'role' => 'Social Worker',
                'location' => 'Islamabad, Pakistan',
                'content' => 'I admire how this tour supports local communities. Ethical, meaningful, and impactful—exactly what responsible tourism should be.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Erik Johansson',
                'role' => 'Scientist',
                'location' => 'Stockholm, Sweden',
                'content' => 'Great educational opportunities about ecosystems and conservation. Ideal for field researchers and nature enthusiasts.',
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Lina Tan',
                'role' => 'Interior Designer',
                'location' => 'Kuala Lumpur, Malaysia',
                'content' => 'The blend of traditional and modern interior design was inspiring. I collected many ideas for future projects.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Gabriel Silva',
                'role' => 'Actor',
                'location' => 'São Paulo, Brazil',
                'content' => 'Interacting with local cultures felt like a real-life acting workshop. Emotionally rich and deeply immersive.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Amelia Hart',
                'role' => 'Retired Teacher',
                'location' => 'Wellington, New Zealand',
                'content' => 'Every moment was peaceful and well-planned. This was the dream retirement trip I always imagined.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Darius Lee',
                'role' => 'Tech Entrepreneur',
                'location' => 'San Francisco, USA',
                'content' => 'Perfect mix of exploration and productivity. Stable Wi-Fi and quiet workspaces allowed me to stay on top of work.',
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Leila Abbas',
                'role' => 'Journalist',
                'location' => 'Beirut, Lebanon',
                'content' => 'I gathered powerful human-interest stories. The narratives from locals were heartfelt and deeply moving.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        DB::table('testimonials')->insert($testimonials);
    }
}
