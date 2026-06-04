<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KafkaProducerController;
use App\Models\KafkaMessage;

Route::get('/kafka-messages', function () {
    return KafkaMessage::latest()->get();
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kafka-send', [KafkaProducerController::class, 'send']);

Route::get('/dashboard', function () {
    $messages = KafkaMessage::latest()->get();
    return view('dashboard', compact('messages'));
});

Route::get('/kafka-status', [KafkaProducerController::class, 'healthCheck']);