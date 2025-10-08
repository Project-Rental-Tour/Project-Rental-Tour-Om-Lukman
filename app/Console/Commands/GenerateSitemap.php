<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Destination;
use App\Models\Car;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate sitemap.xml for public pages';

    public function handle()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0)->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY))
            ->add(Url::create('/about')->setPriority(0.8))
            ->add(Url::create('/faq')->setPriority(0.7))
            ->add(Url::create('/gallery')->setPriority(0.8))
            ->add(Url::create('/list-car')->setPriority(0.9))
            ->add(Url::create('/destination')->setPriority(0.9))
            ->add(Url::create('/custom-trip')->setPriority(0.8));

        // Ambil SEMUA destination (tanpa filter is_active)
        foreach (Destination::all() as $destination) {
            // Pastikan slug ada
            if ($destination->slug) {
                $sitemap->add(Url::create("/destinations/{$destination->slug}")
                    ->setPriority(0.9)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));
            }
        }

        // Ambil SEMUA mobil
        foreach (Car::all() as $car) {
            if ($car->slug) {
                $sitemap->add(Url::create("/car/{$car->slug}")
                    ->setPriority(0.8)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));
            }
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('✅ Sitemap generated successfully at public/sitemap.xml');
    }
}
