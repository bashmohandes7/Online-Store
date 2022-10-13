<?php

namespace App\Http\Interfaces;

interface CheckoutInterface
{
    public function create($cart);
    public function store($request, $cart);
} // end class CheckoutInterface
