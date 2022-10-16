<?php

namespace App\Providers;

use App\Actions\Fortify\AuthenticateUser;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Support\Facades\RateLimiter;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use App\Actions\Fortify\UpdateUserProfileInformation;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $request = request();
        if ($request->is('admin/*')) {
            Config::set([
                'fortify.guard' => 'admin',
                'fortify.prefix' => 'admin',
                'fortify.passwords' => 'admins',
                'fortify.home' => 'admin'
            ]);
        }
        $this->app->instance(LoginResponse::class, new class implements LoginResponse
        {
            public function toResponse($request)
            {
                return $request->user('admin') ? redirect()->intended('admin/') : redirect()->intended('/');
            }
        }); // end of login response
        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse
        {
            public function toResponse($request)
            {
                return redirect('/');
            }
        }); // end of logout response
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email . $request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        if (Config::get('fortify.guard') == 'admin') {
            Fortify::authenticateUsing([AuthenticateUser::class, 'authenticate']); // to login with email, username or phone_number
            return Fortify::viewPrefix('auth.'); // to append breeze views to fortify
        } else {
            return Fortify::viewPrefix('front.auth.');
        }
    }
}
