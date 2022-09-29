<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // macros methodology
        Validator::extend('filter', function($attribute, $value, $params){
            return ! in_array(strtolower($value), $params);
        },'this name is  not allowed right now'); // end of macro

        Paginator::useBootstrapFour(); // end of paginator
    }
}
