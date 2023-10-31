<?php
/**
* This is just a template for building service providers
* All providers should be placed in this Providers directory.
* "The place for any Service Providers you care to define for your theme.
* Comes with ThemeServiceProvider that adds no functionality but provides a template for your own Service Providers." - From Sage Docs
* https://roots.io/sage/docs/functionality/
* https://laravel.com/docs/10.x/providers 
*/
namespace App\Providers;

use Roots\Acorn\Sage\SageServiceProvider;

class ThemeServiceProvider extends SageServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
