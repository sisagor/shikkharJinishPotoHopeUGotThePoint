<?php

namespace App\Drivers;

use telesign\sdk\messaging\MessagingClient;
use Tzsk\Sms\Contracts\Driver;

class Telesign extends Driver
{

    protected MessagingClient $client;

    protected $messageType = "ARN";

    protected function boot(): void
    {
        $this->client = new MessagingClient(data_get($this->settings, 'customer_id'), data_get($this->settings, 'api_key'));
    }

    public function send()
    {
        $response = collect();

        foreach ($this->recipients as $recipient) {
            /**
             * @psalm-suppress UndefinedMagicPropertyFetch
             */
            $result = $this->client->message($recipient, $this->body, $this->messageType);

            $response->put($recipient, $result);
        }

        return (count($this->recipients) == 1) ? $response->first() : $response;
    }
}

