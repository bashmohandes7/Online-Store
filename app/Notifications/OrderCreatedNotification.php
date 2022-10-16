<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;
    protected $order;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $channels = ['database'];
        if ($notifiable->notification_preferences['order_created']['mail'] ?? false) {
            $channels[] = 'mail';
        }
        if ($notifiable->notification_preferences['order_created']['sms'] ?? false) {
            $channels[] = 'nexmo';
        }
        if ($notifiable->notification_preferences['order_created']['broadcast'] ?? false) {
            $channels[] = 'broadcast';
        }
        return $channels;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $addr = $this->order->billingAddress;
        return (new MailMessage)
            ->subject("New Order #{$this->order->number}")
            ->from('notification@store-store.ps', 'Online Store')
            ->replyTo('diaaemad1@gmail.com', 'Diaa Abdallah')
            ->greeting("Hi {$notifiable->name},")
            ->line("A new order (#{$this->order->number}) created by {$addr->name} from {$addr->country_name}.")
            ->action('View Order', url('/dashboard'))
            ->line('Thank you for using our application!');
    }
    public function toDatabase($notifiable)
    {
        $addr = $this->order->billingAddress;
        $body = sprintf(
            'New Order Number %s created by %s from %s',
            $this->order->number,
            $addr->name,
            $addr->country_name
        );
        return [
            'body' => $body,
            'icon' => 'fas fa-file',
            'url' => url('admin')
        ];
    }

    public function toBroadcast($notifiable)
    {
        $addr = $this->order->billingAddress;
        $body = sprintf(
            'New Order Number %s created by %s from %s',
            $this->order->number,
            $addr->name,
            $addr->country_name
        );
        return [
            'body' => $body,
            'icon' => 'fas fa-file',
            'url' => url('admin')
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}