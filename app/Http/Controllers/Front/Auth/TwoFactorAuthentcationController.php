<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Doctrine\DBAL\Schema\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorAuthentcationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('front.auth.two-factor-auth', compact('user'));
    } // end of index
}
