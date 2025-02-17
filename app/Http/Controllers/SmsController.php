<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;

class SmsController extends Controller
{
    public function sms()
    {
        $basic  = new Basic("94981ce7", "Qrf2Fk5LlgsLbGWP");
        $client = new Client($basic);

        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("201289396889", 'BRAND_NAME', 'A text message sent using the Nexmo SMS API')
        );

        $message = $response->current();

        if ($message->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }
    }
}
