<?php

/*
|--------------------------------------------------------------------------
| FIX FOR LARAVEL KAFKA WITHOUT ext-rdkafka
|--------------------------------------------------------------------------
|
| This constant normally comes from ext-rdkafka extension.
| Since XAMPP does not have it, we define it manually.
|
*/

if (!defined('RD_KAFKA_PARTITION_UA')) {
    define('RD_KAFKA_PARTITION_UA', -1);
}

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();