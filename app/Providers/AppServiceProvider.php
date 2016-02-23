<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bladeDirectives();
    }

    /**
     * Extend Blade with new directives
     *
     * @return void
     */
    public function bladeDirectives()
    {
        // Format percentage with fixed decimal part and symbol
        Blade::directive('percentage', function ($expression) {
            return "<?php echo number_format(floatval($expression), 2).' %'; ?>";
        });
        // Format price with fixed decimal part and currency
        Blade::directive('price', function ($expression) {
            return "<?php echo number_format(floatval($expression), 2).' '.config('core.currency'); ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
