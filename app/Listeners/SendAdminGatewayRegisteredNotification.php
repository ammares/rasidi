<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\ClientGateway;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\GatewayRegistered;
use App\Notifications\GatewayRegister;
use Illuminate\Support\Facades\Notification;


class SendAdminGatewayRegisteredNotification
{
    /**
     * Handle the event.
     *
     * @param ClientCreated $event
     * @return void
     */
     public function handle(GatewayRegistered $event)
     {
         $admins = User::role('admin')->get();
 
         Notification::send($admins, new GatewayRegister($event->client_gateway));
     }
}
