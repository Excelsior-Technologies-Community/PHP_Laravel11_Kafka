<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Junges\Kafka\Facades\Kafka;

class KafkaConsumerCommand extends Command
{
    protected $signature = 'kafka:consume';

    protected $description = 'Consume Kafka Messages';

    public function handle()
    {
        Kafka::createConsumer(['test-topic'])
            ->withHandler(function($message){

                echo "Received Message: ";
                print_r($message->getBody());

            })
            ->build()
            ->consume();
    }
}