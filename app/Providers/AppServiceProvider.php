<?php

namespace App\Providers;

use App\Services\CurrencyConverter;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('currency.converter', function () {
            return new CurrencyConverter(config('services.currency_converter.api_key'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // macros methodology
        Validator::extend('filter', function ($attribute, $value, $params) {
            return !in_array(strtolower($value), $params);
        }, 'this name is  not allowed right now'); // end of macro

        Paginator::useBootstrapFour(); // end of paginator

        App::setLocale(request('locale', 'en'));
        //App::setLocale(request()->header('X-Language' ,'en'));
    }
}
