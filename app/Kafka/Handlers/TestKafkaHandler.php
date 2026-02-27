<?php

namespace App\Kafka\Handlers;

use Junges\Kafka\Contracts\KafkaConsumerMessage;

class TestKafkaHandler
{
    public function __invoke(KafkaConsumerMessage $message)
    {
        echo "Received Message: ";
        print_r($message->getBody());
    }
}