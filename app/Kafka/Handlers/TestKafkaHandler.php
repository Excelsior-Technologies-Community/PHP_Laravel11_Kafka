<?php

namespace App\Kafka\Handlers;

use Junges\Kafka\Contracts\KafkaConsumerMessage;
use Junges\Kafka\Contracts\Consumer; 

class TestKafkaHandler implements Consumer
{
    public function handle(KafkaConsumerMessage $message): void
    {
        echo "Received Message: " . $message->getBody();
    }
}