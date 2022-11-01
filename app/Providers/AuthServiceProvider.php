<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function register()
    {
        parent::register();


        Gate::before(function ($user, $permission) {
            if ($user->super_admin) {
                return true;
            }
        });
        $this->app->bind('permissions', function () {
            return include base_path('data/permissions.php');
        });
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        foreach ($this->app->make('permissions') as $permission => $value) {
            Gate::define($permission, function ($user) use ($permission) {
                $user->hasPermission($permission);
            });
        } // end of foreach
    }
}
