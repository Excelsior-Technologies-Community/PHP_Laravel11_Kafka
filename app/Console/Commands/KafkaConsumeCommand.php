<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Junges\Kafka\Facades\Kafka;
use App\Models\KafkaMessage;

class KafkaConsumerCommand extends Command
{
    protected $signature = 'kafka:consume';

    protected $description = 'Consume Kafka Messages';

    public function handle()
    {
        Kafka::createConsumer(['test-topic'])
            ->withHandler(function ($message) {

                $data = $message->getBody();

                // Save message into database
                KafkaMessage::create([
                    'message' => json_encode($data)
                ]);

                echo "Saved Message: ";
                print_r($data);
                echo "\n";

            })
            ->build()
            ->consume();
    }
}