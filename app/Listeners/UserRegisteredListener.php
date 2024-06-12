<?php

namespace App\Listeners;

// use App\Events\UserRegistered;
use App\Events\AdminNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UserRegisteredListener
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
     * @param  \App\Events\AdminNotification  $event
     * @return void
     */
    public function handle(AdminNotification $event)
    {
        dd($message);
        // Lấy thông báo từ sự kiện
        $message = $event->message;

        broadcastOn(new AdminNotification($message));
    }
}
