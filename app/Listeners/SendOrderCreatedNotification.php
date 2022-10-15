<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\OrderCreatedEvent;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrderCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCreatedEvent $event)
    {
        $order = $event->order;
        $user = User::where('store_id', $order->store_id)->first();
        if ($user) {
            $user->notify(new OrderCreatedNotification($order));
        }
    }
}
