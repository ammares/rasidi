<?php

namespace App\Events;

use App\Models\ClientGateway;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GatewayRegistered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $client_gateway;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ClientGateway $client_gateway)
    {
        $this->client_gateway = $client_gateway;
    }

}
