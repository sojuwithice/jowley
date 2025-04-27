<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Collection;

class NotificationsModal extends Component
{
    public Collection $notifications;
    public int $unreadCount;

    public function __construct($notifications = [], int $unreadCount = 0)
    {
        $this->notifications = collect($notifications);
        $this->unreadCount = $unreadCount;
    }

    public function render()
{
    return view('components.notifications-modal', [
        'notifications' => $this->notifications,
        'unreadCount' => $this->unreadCount
    ]);
}
}