<?php

namespace App\Providers;

use App\Http\Interfaces\CartInterface;
use Illuminate\Support\ServiceProvider;
use App\Http\Repositories\CartRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Http\Interfaces\DashboardInterface',
            'App\Http\Repositories\DashboardRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\CategoryInterface',
            'App\Http\Repositories\CategoryRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\ProductInterface',
            'App\Http\Repositories\ProductRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\ProfileInterface',
            'App\Http\Repositories\ProfileRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\CartInterface',
            'App\Http\Repositories\CartRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\CheckoutInterface',
            'App\Http\Repositories\CheckoutRepository'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
