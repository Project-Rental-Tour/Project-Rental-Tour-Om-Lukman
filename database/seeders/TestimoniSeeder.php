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
                'name' => 'Ahmad Rizki',
                'role' => 'Travel Blogger',
                'location' => 'Jakarta, Indonesia',
                'content' => 'Perjalanan yang sangat menyenangkan! Pelayanan timnya profesional dan destinasi yang ditawarkan sangat memukau. Pasti akan merekomendasikan ke teman-teman.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Sarah Wijaya',
                'role' => 'Photographer',
                'location' => 'Bandung, Indonesia',
                'content' => 'Sebagai photographer, saya sangat menghargai keindahan tempat-tempat yang dikunjungi. Pemandangan yang menakjubkan dan cocok untuk diabadikan.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Budi Santoso',
                'role' => 'Businessman',
                'location' => 'Surabaya, Indonesia',
                'content' => 'Perjalanan bisnis yang sangat efisien. Semua diatur dengan baik sehingga saya bisa fokus pada meeting tanpa khawatir dengan logistik.',
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Lisa Anderson',
                'role' => 'Teacher',
                'location' => 'New York, USA',
                'content' => 'Saya membawa siswa-siswa saya dalam perjalanan edukasi dan semuanya berjalan lancar. Anak-anak sangat senang dan belajar banyak.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Kenji Tanaka',
                'role' => 'Tourist',
                'location' => 'Tokyo, Japan',
                'content' => 'Pengalaman budaya yang sangat menarik. Pemandu wisata sangat informatif dan membantu saya memahami budaya lokal dengan lebih baik.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Maria Garcia',
                'role' => 'Student',
                'location' => 'Madrid, Spain',
                'content' => 'Perjalanan yang sempurna untuk budget pelajar. Semua fasilitas sesuai dengan harga dan saya bisa mengalami petualangan yang menyenangkan.',
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Robert Johnson',
                'role' => 'Retiree',
                'location' => 'London, UK',
                'content' => 'Sebagai pensiunan, saya menghargai tempo perjalanan yang tidak terburu-buru. Semua diatur dengan baik dan staff sangat membantu.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Chen Wei',
                'role' => 'Entrepreneur',
                'location' => 'Beijing, China',
                'content' => 'Saya sangat terkesan dengan profesionalisme tim. Mereka responsif terhadap semua permintaan saya dan memberikan solusi terbaik.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Amanda Lee',
                'role' => 'Food Vlogger',
                'location' => 'Singapore',
                'content' => 'Kuliner yang ditawarkan selama perjalanan sangat autentik dan lezat. Bahan-bahan segar dan teknik memasak yang tradisional.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'David Muller',
                'role' => 'Engineer',
                'location' => 'Berlin, Germany',
                'content' => 'Semua jadwal tepat waktu dan transportasi sangat nyaman. Efisiensi yang saya hargai sebagai seorang engineer.',
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Nina Patel',
                'role' => 'Doctor',
                'location' => 'Mumbai, India',
                'content' => 'Setelah bulan-bulan yang penuh tekanan di rumah sakit, perjalanan ini benar-benar menyegarkan. Tempatnya sangat peacefull dan menenangkan.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Michael Brown',
                'role' => 'Freelancer',
                'location' => 'Sydney, Australia',
                'content' => 'Sebagai freelancer, saya bisa bekerja sambil menikmati perjalanan. Koneksi internet yang stabil dan tempat kerja yang nyaman.',
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Sophie Martin',
                'role' => 'Artist',
                'location' => 'Paris, France',
                'content' => 'Pemandangan yang inspiratif untuk karya seni saya. Warna, tekstur, dan budaya lokal memberikan banyak ide baru.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'James Wilson',
                'role' => 'Writer',
                'location' => 'Toronto, Canada',
                'content' => 'Banyak cerita dan pengalaman yang bisa saya tuangkan dalam tulisan. Orang-orang lokal sangat ramah dan berbagi cerita menarik.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Elena Rossi',
                'role' => 'Architect',
                'location' => 'Rome, Italy',
                'content' => 'Arsitektur lokal yang menakjubkan! Saya belajar banyak tentang teknik bangunan tradisional dan bagaimana mereka beradaptasi dengan lingkungan.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Thomas Kim',
                'role' => 'Digital Nomad',
                'location' => 'Seoul, South Korea',
                'content' => 'Perfect balance between work and adventure. The accommodations were comfortable with great amenities for remote workers.',
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Olivia Davis',
                'role' => 'Yoga Instructor',
                'location' => 'Bali, Indonesia',
                'content' => 'Tempat yang sempurna untuk retreat dan meditation. Energinya sangat positif dan alamnya masih sangat alami.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'William Taylor',
                'role' => 'Historian',
                'location' => 'Cambridge, UK',
                'content' => 'Nilai sejarah dan budaya yang sangat kaya. Pemandu sangat knowledgeable dan bisa menjawab semua pertanyaan detail saya.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Aisha Mohammed',
                'role' => 'Environmentalist',
                'location' => 'Cape Town, South Africa',
                'content' => 'Saya menghargai komitmen terhadap sustainable tourism. Mereka benar-benar peduli dengan lingkungan dan masyarakat lokal.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Daniel White',
                'role' => 'Adventure Seeker',
                'location' => 'Queenstown, New Zealand',
                'content' => 'Bagi pencinta adrenalin seperti saya, aktivitas yang ditawarkan sangat menantang dan safety procedure-nya sangat baik.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Maya Singh',
                'role' => 'Family Traveler',
                'location' => 'New Delhi, India',
                'content' => 'Perjalanan yang ramah keluarga. Anak-anak saya sangat senang dan banyak aktivitas yang sesuai untuk semua usia.',
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ryan Clark',
                'role' => 'Solo Traveler',
                'location' => 'Vancouver, Canada',
                'content' => 'Sebagai solo traveler, saya merasa aman dan nyaman. Bertemu banyak traveler lain dan membuat kenangan indah.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Emma Wright',
                'role' => 'Honeymooner',
                'location' => 'Maldives',
                'content' => 'Honeymoon yang sempurna! Suasana romantis, privasi terjaga, dan pelayanan yang sangat personal.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Lucas Garcia',
                'role' => 'Diver',
                'location' => 'Cairns, Australia',
                'content' => 'Spot diving yang menakjubkan! Terumbu karang masih sangat terjaga dan kehidupan lautnya sangat beragam.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Chloe Robinson',
                'role' => 'Wildlife Photographer',
                'location' => 'Nairobi, Kenya',
                'content' => 'Kesempatan bagus untuk mengamati dan memotret satwa liar dalam habitat alami mereka. Pemimpin tur sangat respect terhadap alam.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Noah Allen',
                'role' => 'Backpacker',
                'location' => 'Bangkok, Thailand',
                'content' => 'Nilai yang sangat baik untuk uang yang dikeluarkan. Akomodasi bersih, transportasi mudah, dan makanan enak dengan harga terjangkau.',
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Isabella King',
                'role' => 'Luxury Traveler',
                'location' => 'Dubai, UAE',
                'content' => 'Pengalaman luxury yang worth every penny. Fasilitas premium, pelayanan exceptional, dan attention to detail yang impressive.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Benjamin Green',
                'role' => 'Cultural Researcher',
                'location' => 'Kyoto, Japan',
                'content' => 'Akses ke komunitas lokal dan tradisi yang autentik. Bisa belajar langsung dari masyarakat tentang budaya mereka.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Charlotte Scott',
                'role' => 'Festival Goer',
                'location' => 'Rio de Janeiro, Brazil',
                'content' => 'Waktu yang tepat untuk mengalami festival budaya. Energi masyarakat sangat contagious dan membuat saya ikut bersemangat.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Henry Adams',
                'role' => 'Food Enthusiast',
                'location' => 'Mexico City, Mexico',
                'content' => 'Tour kuliner yang luar biasa! Bisa mencicipi makanan street food yang autentik sampai fine dining dengan cita rasa lokal.',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('testimonials')->insert($testimonials);
    }
}
