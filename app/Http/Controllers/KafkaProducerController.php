<?php

namespace App\Http\Controllers;

class KafkaProducerController extends Controller
{
    public function send()
    {
        return "Kafka Message Sent Successfully (Demo Mode)";
    }
}