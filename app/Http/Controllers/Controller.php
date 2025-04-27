<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function getNotifications()
{
    if (!auth()->check()) {
        return ['notifications' => [], 'unreadCount' => 0];
    }

    return [
        'notifications' => auth()->user()->notifications()
                              ->latest()
                              ->take(5)
                              ->get()
                              ->toArray(),
        'unreadCount' => auth()->user()->unreadNotifications()->count()
    ];
}
}
