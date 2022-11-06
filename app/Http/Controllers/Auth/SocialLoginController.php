<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    } // end of redirect

    public function callback()
    {
        $providerUser = Socialite::driver('github')->stateless()->user();
        $user = User::firstOrCreate([
            'provider_id' => $providerUser->id,
        ],[
            'name' => $providerUser->name,
            'email' => $providerUser->email,
            'password' => Str::random(8),
            'provider_id' => $providerUser->id,
            'provider_token' => $providerUser->token
        ]);
        Auth::login($user);
        return to_route('home');
    } // end of callback
}
