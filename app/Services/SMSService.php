<?php

namespace App\Services;

use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class SMSService
{
    protected $client;
    protected $fromNumber;

    public function __construct()
    {
        $this->client = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );
        $this->fromNumber = config('services.twilio.from');
    }
    
    public function sendSMS($phoneNumber, $message)
    {
        try {
            $message = $this->client->messages->create(
                $phoneNumber, // To number
                [
                    'from' => $this->fromNumber,
                    'body' => $message
                ]
            );

            Log::info('SMS sent successfully', [
                'to' => $phoneNumber,
                'message_sid' => $message->sid
            ]);

            return true;
            
        } catch (\Exception $e) {
            Log::error('SMS sending failed: ' . $e->getMessage());
            return false;
        }
    }
}