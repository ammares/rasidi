<?php

namespace App\Listeners;

use App\Events\ClientCreated;
use App\Models\User;
use App\Notifications\NewClient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendAdminNewClientNotification
{
    /**
     * Handle the event.
     *
     * @param ClientCreated $event
     * @return void
     */
    public function handle(ClientCreated $event)
    {
        $admins = User::role('admin')->get();

        Notification::send($admins, new NewClient($event->client));
    }
}
