<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\OrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class OrderListener
{

    public function __construct()
    {
        //
    }

    public function handle($event)
    {
        User::where('utype', 'ADM')
            ->each(function(User $user) use($event){
               Notification::send($user, new OrderNotification($event->order)); 
            });
    }
}
