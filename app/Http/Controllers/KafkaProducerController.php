<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\KafkaMessage;

class KafkaProducerController extends Controller
{
    public function send(Request $request)
    {
        $message = $request->input('message', 'Default Kafka Message');

        // Simulate Kafka message (log)
        Log::info('Kafka Message Sent', [
            'message' => $message,
            'time' => now()
        ]);

        // Save into database (simulate consumer)
        KafkaMessage::create([
            'message' => json_encode([
                'message' => $message,
                'time' => now()
            ])
        ]);

        return response()->json([
            'status' => 'Message Sent & Stored (Simulated)',
            'data' => $message
        ]);
    }
}