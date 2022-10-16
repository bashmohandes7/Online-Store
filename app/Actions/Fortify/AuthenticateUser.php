<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AuthenticateUser
{
    public static  function authenticate($request)
    {
        $userName = $request->post(config('fortify.username'));
        $user = Admin::where('username', '=', $userName)
            ->orWhere('email', '=', $userName)
            ->orWhere('phone_number', '=', $userName)
            ->first();
        if ($user && Hash::check($request->post('password'), $user->password)) {
            return $user;
        } else {
            return false;
        }
    } // end of authenticate
} // end of Authenticate User
