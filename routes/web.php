<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KafkaProducerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kafka-send', [KafkaProducerController::class, 'send']);

