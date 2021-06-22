<?php

namespace Modules\Admin\Http\Controllers;

use App\Services\phpMQTT;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Carbon\Carbon;

class MqttController extends Controller
{
    public function index()
    {
        return view('admin::welcome');
    }

    public function send(Request $request)
    {
        $server = 'localhost';     // change if necessary
        $port = 1883;                     // change if necessary
        $username = 'cp-mqtt';                   // set your username
        $password = 'kvXVP2EQ';                   // set your password
        $client_id = 'phpMQTT-publisher'; // make sure this is unique for connecting to sever - you could use uniqid()

        $mqtt = new phpMQTT($server, $port, $client_id);

        echo "Sending message on topic 'test'\n";
        if ($mqtt->connect(true, NULL, $username, $password)) {
            $message = "{ \"data\" : \"some data gose here\", ";
            $message.= " \"at\" : \"" . Carbon::now() . "\", ";
            $message.= " \"Authorization\" : \"Bearer " . $request->input('token') . "\"} ";
            $mqtt->publish('gateway/test', $message, 0, false);
            $mqtt->close();
            echo "Message sent!\n";
        } else {
            echo "Time out!\n";
        }
    }
}
