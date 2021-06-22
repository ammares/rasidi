<?php

namespace App\Notifications;

use App\Models\ClientGateway;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GatewayRegister extends Notification
{
    use Queueable;

    private $client_gateway;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ClientGateway $client_gateway)
    {
        $this->client_gateway = $client_gateway;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'client_id' => $this->client_gateway->client_id,
            'gateway_id' => $this->client_gateway->gateway_id,
            'message' => __('global.new_gateway_has_been_registrated'),
        ];
    }
}
