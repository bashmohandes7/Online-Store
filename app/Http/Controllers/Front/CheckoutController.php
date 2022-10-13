<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\CartInterface;
use App\Http\Interfaces\CheckoutInterface;
use App\Http\Requests\Front\CheckoutRequest;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    private CheckoutInterface $checkoutInterface;

    public function __construct(CheckoutInterface $checkoutInterface)
    {
        $this->checkoutInterface = $checkoutInterface;
    } // end of constructor

    public function create(CartInterface $cart)
    {
        return $this->checkoutInterface->create($cart);
    } // end of create

    public function store(CheckoutRequest $request, CartInterface $cart)
    {
        return $this->checkoutInterface->store($request, $cart);
    } // end of store
}
