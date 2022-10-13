<?php

namespace App\Http\Repositories;

use Throwable;
use App\Models\Order;
use App\Models\OrderDetails;
use Doctrine\DBAL\Schema\View;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Intl\Countries;
use App\Http\Interfaces\CheckoutInterface;
use App\Models\OrderAddress;
use Illuminate\Support\Facades\Auth;

class CheckoutRepository implements CheckoutInterface
{
    public function create($cart)
    {
        if ($cart->get()->count() == 0) {
            return to_route('home');
        }
        return View('front.checkout.checkout', [
            'cart' => $cart,
            'countries' => Countries::getNames(),
        ]);
    } // end of create

    public function store($request, $cart)
    {
        $request->validate([
            'addr.billing.first_name' => ['required', 'string', 'max:255'],
            'addr.billing.last_name' => ['required', 'string', 'max:255'],
            'addr.billing.email' => ['required', 'string', 'max:255'],
            'addr.billing.phone_number' => ['required', 'string', 'max:255'],
            'addr.billing.city' => ['required', 'string', 'max:255'],
        ]);

        $items = $cart->get()->groupBy('product.store_id')->all();

        DB::beginTransaction();
        try {
            foreach ($items as $store_id => $cart_items) {

                $order = Order::create([
                    'store_id' => $store_id,
                    'user_id' => Auth::id(),
                    'payment_method' => 'cod',
                ]);

                foreach ($cart_items as $item) {
                    OrderDetails::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,
                    ]);
                } // end of cart items foreach

                foreach ($request->post('addr') as $type => $address) {
                    $address['type'] = $type;
                    $address['order_id'] = $order->id;
                    $order->addresses()->create($address);
                } // end of addresses foreach
            } // end of main foreach

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return to_route('home');
    } // end of store
} //end of CheckoutRepository class
