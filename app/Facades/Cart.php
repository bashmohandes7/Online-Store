<?php

namespace App\Facades;

use App\Http\Interfaces\CartInterface;
use Illuminate\Support\Facades\Facade;

class Cart extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CartInterface::class;
    } // end of getFacadeAccessor
} // end of cart class
