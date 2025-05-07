<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class OrderStatusUpdated extends Notification
{
    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['database']; // Store the notification in the database
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Order Status Updated',
            'message' => 'Your order #' . $this->order->id . ' is now ' . $this->order->status . '.',
            'order_id' => $this->order->id,
        ];
    }
}
