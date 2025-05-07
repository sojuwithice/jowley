<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class OrderUpdated extends Notification
{
    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Order Status Updated',
            'message' => "Your order #{$this->order->id} has been updated to '{$this->order->status}'.",
            'action_url' => route('user.orders.show', $this->order->id),
            'image' => asset('image/order-status.png'), // optional image
        ];
    }
}
