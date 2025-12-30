<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade; // <--- 1. Wajib Import Ini

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 2. Mendaftarkan Shortcut @translate
        Blade::directive('translate', function ($expression) {
            return "<?php echo \App\Helpers\TranslationHelper::translate($expression); ?>";
        });

        // 3. Mendaftarkan Shortcut @currency
        Blade::directive('currency', function ($expression) {
            return "<?php echo \App\Helpers\CurrencyHelper::convert($expression); ?>";
        });
    }
}