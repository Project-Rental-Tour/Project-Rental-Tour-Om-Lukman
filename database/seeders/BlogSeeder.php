<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogPost;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = [
            [
                'title' => 'Exploring the Hidden Waterfalls of Bali',
                'content' => '<p>Bali is not just about beaches and temples. Deep in the jungles of Ubud and Munduk, you’ll find stunning hidden waterfalls like Tukad Cepung, Gitgit, and Aling-Aling. These natural wonders offer breathtaking views and refreshing swims in pristine waters.</p><p>This guide covers the best hidden waterfalls, how to get there, and tips for capturing the perfect photo.</p>',
                'featured_image' => 'images/blogs/bali-waterfalls.jpg',
                'type' => 'Destination',
                'reading_time' => '5',
                'author' => 'Adi Santoso',
            ],
            [
                'title' => 'The Art of Batik: Indonesia’s Cultural Heritage',
                'content' => '<p>Batik is more than just fabric; it’s a symbol of Indonesian culture and identity. Recognized by UNESCO as a Masterpiece of Oral and Intangible Heritage, batik involves intricate wax-resist dyeing techniques passed down through generations.</p><p>In this article, we explore the history, meaning, and regional variations of batik across Java, Sumatra, and beyond.</p>',
                'featured_image' => 'images/blogs/batik-art.jpg',
                'type' => 'Culture',
                'reading_time' => '7',
                'author' => 'Lina Wijaya',
            ],
            [
                'title' => 'Must-Try Street Food in Jakarta',
                'content' => '<p>Jakarta may be a bustling metropolis, but its streets are filled with culinary gems. From sizzling <em>martabak</em> to spicy <em>kerak telor</em>, the capital’s street food scene is a paradise for food lovers.</p><p>Here’s a curated list of the top 10 street foods you must try when visiting Jakarta.</p>',
                'featured_image' => 'images/blogs/jakarta-street-food.jpg',
                'type' => 'Food',
                'reading_time' => '4',
                'author' => 'Rina Kartika',
            ],
            [
                'title' => 'Travel Photography Tips for Beginners',
                'content' => '<p>Capturing stunning travel photos doesn’t require expensive gear—just the right mindset and technique. Whether you’re using a DSLR or smartphone, these tips will help you take better photos on your next adventure.</p><p>Learn about composition, lighting, golden hour, and how to photograph people respectfully.</p>',
                'featured_image' => 'images/blogs/travel-photography.jpg',
                'type' => 'Photography',
                'reading_time' => '6',
                'author' => 'Budi Pratama',
            ],
            [
                'title' => 'How to Plan a Budget-Friendly Trip to Yogyakarta',
                'content' => '<p>Yogyakarta is one of Indonesia’s most affordable and culturally rich destinations. From ancient temples to vibrant art scenes, there’s so much to explore without breaking the bank.</p><p>This guide walks you through budget-friendly accommodations, local eats, transportation tips, and free attractions.</p>',
                'featured_image' => 'images/blogs/yogyakarta-budget.jpg',
                'type' => 'Tips & Guide',
                'reading_time' => '8',
                'author' => 'Dewi Sari',
            ],
            [
                'title' => 'Raja Ampat: The Ultimate Diving Paradise',
                'content' => '<p>Raja Ampat in West Papua is home to the richest marine biodiversity on Earth. With crystal-clear waters, vibrant coral reefs, and rare sea life, it’s a dream destination for divers and nature lovers.</p><p>Find out the best time to visit, how to get there, and eco-friendly resorts that support conservation.</p>',
                'featured_image' => 'images/blogs/raja-ampat.jpg',
                'type' => 'Destination',
                'reading_time' => '9',
                'author' => 'Agus Setiawan',
            ],
            [
                'title' => 'Traditional Festivals in Bali You Shouldn’t Miss',
                'content' => '<p>Bali is known for its spiritual energy and vibrant festivals. From Nyepi (Day of Silence) to Galungan and Ubud Writers Festival, each celebration offers a unique glimpse into Balinese Hindu culture.</p><p>Here’s your guide to the top festivals and how to experience them respectfully.</p>',
                'featured_image' => 'images/blogs/bali-festivals.jpg',
                'type' => 'Culture',
                'reading_time' => '6',
                'author' => 'Putu Angga',
            ],
            [
                'title' => 'The Flavors of Padang: A Culinary Journey',
                'content' => '<p>Padang cuisine from West Sumatra is famous for its bold spices, rich coconut milk, and communal serving style. Dishes like rendang, sambal lado, and gulai are now beloved worldwide.</p><p>Discover the history, ingredients, and best places to enjoy authentic Padang food.</p>',
                'featured_image' => 'images/blogs/padang-food.jpg',
                'type' => 'Food',
                'reading_time' => '5',
                'author' => 'Fauzan Malik',
            ],
        ];

        foreach ($blogs as $blog) {
            BlogPost::create([
                'title' => $blog['title'],
                'slug' => Str::slug($blog['title']),
                'content' => $blog['content'],
                'featured_image' => $blog['featured_image'],
                'type' => $blog['type'],
                'reading_time' => $blog['reading_time'],
                'author' => $blog['author'],
            ]);
        }
    }
}
