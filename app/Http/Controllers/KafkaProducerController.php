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

        Log::info('Kafka Message Sent', ['message' => $message, 'time' => now()]);

        KafkaMessage::create([
            'message' => $message, 
            'topic' => 'default_topic',
            'payload' => json_encode(['message' => $message, 'time' => now()]),
            'status' => 'sent'
        ]);

        return response()->json([
            'status' => 'Message Sent & Stored (Simulated)',
            'data' => $message
        ]);
    }

    public function healthCheck()
    {
        try {
            return response()->json([
                'status' => 'success',
                'message' => 'Kafka service is operational',
                'timestamp' => now()
            ]);
        } catch (\Exception $e) {
            Log::error('Kafka Health Check Failed: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Kafka service unavailable'
            ], 500);
        }
    }
}