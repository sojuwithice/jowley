<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View as ViewContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Share notifications data with all views
        View::composer('*', function (ViewContract $view) {
            $notifications = [];
            $unreadCount = 0;
            
            if (auth()->check()) {
                $user = auth()->user();
                $notifications = $user->notifications()
                    ->latest()
                    ->take(5)
                    ->get();
                $unreadCount = $user->unreadNotifications()->count();
            }
            
            $view->with([
                'notifications' => $notifications,
                'unreadCount' => $unreadCount
            ]);
        });

        // Register blade components
        Blade::component('notifications-modal', \App\View\Components\NotificationsModal::class);
    }
}