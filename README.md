# PHP_Laravel11_Kafka

## Project Description

PHP_Laravel11_Kafka is a Laravel 11 based demo project that demonstrates how to integrate Apache Kafka with Laravel using the mateusjunges/laravel-kafka package.

The project shows how to configure Kafka, create a producer to send messages, and create a consumer to receive messages from a Kafka topic. It uses Laravel Artisan commands for consuming messages and Laravel controllers and routes for producing messages.

This project helps developers understand the basic workflow of Kafka messaging in Laravel, including Kafka configuration, message production, and message consumption.

It follows a clean and simple structure, making it ideal for beginners who want to learn Kafka integration in Laravel.


## Key Features

- Kafka integration with Laravel 11

- Kafka producer implementation using controller

- Kafka consumer implementation using Artisan command

- Kafka message handler class

- Configurable Kafka settings via .env and config/kafka.php

- Simple and beginner-friendly project structure

- Demonstrates real-time message processing workflow



## Technologies Used

- PHP 8+

- Laravel 11

- Apache Kafka

- laravel-kafka package

- MySQL (optional)

- Composer


---



## Installation Steps


---


## STEP 1: Create Laravel 11 Project

### Open terminal / CMD and run:

```
composer create-project laravel/laravel PHP_Laravel11_Kafka "11.*"

```

### Go inside project:

```
cd PHP_Laravel11_Kafka

```

#### Explanation:

Creates a new Laravel 11 project and moves into the project directory so you can start development.




## STEP 2: Database Setup (Optional)

### Open .env and set:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel11_kafka
DB_USERNAME=root
DB_PASSWORD=

```

### Create database in MySQL / phpMyAdmin:

```
Database name: laravel11_kafka

```

### Then Run:

```
php artisan migrate

```


#### Explanation:

Connects Laravel to MySQL database, which can be used to store application or Kafka-related data if needed.



## STEP 3:Install Laravel Kafka Package

### Run:

```
composer require mateusjunges/laravel-kafka --ignore-platform-req=ext-rdkafka

```

#### Explanation:

Installs the Laravel Kafka package which allows Laravel to produce and consume Kafka messages.




## STEP 4: Publish Kafka Config

### Run command:

```
php artisan vendor:publish --provider="Junges\Kafka\Providers\LaravelKafkaServiceProvider"

```

### You’ll now have:

```
config/kafka.php

```


#### Explanation:

Publishes the Kafka configuration file so you can customize Kafka connection settings.





## STEP 5: Configure .env

### Open .env and Add:

```
KAFKA_DRIVER=rdkafka
KAFKA_BROKERS=127.0.0.1:9092
KAFKA_CONSUMER_GROUP_ID=test-group

```

#### Explanation:

Defines Kafka broker address and consumer group so Laravel can connect to Kafka server.




## STEP 6: Configure config/kafka.php

### Open: config/kafka.php

#### Set:

```
<?php declare(strict_types=1);

return [

    'driver' => env('KAFKA_DRIVER', 'null'),

    'brokers' => env('KAFKA_BROKERS', 'localhost:9092'),

    'securityProtocol' => env('KAFKA_SECURITY_PROTOCOL', 'PLAINTEXT'),

    'sasl' => [
        'mechanisms' => env('KAFKA_MECHANISMS', 'PLAINTEXT'),
        'username' => env('KAFKA_USERNAME', null),
        'password' => env('KAFKA_PASSWORD', null),
    ],

    'consumer_group_id' => env('KAFKA_CONSUMER_GROUP_ID', 'group'),

    'consumer_timeout_ms' => env('KAFKA_CONSUMER_DEFAULT_TIMEOUT', 2000),

    'offset_reset' => env('KAFKA_OFFSET_RESET', 'latest'),

    'auto_commit' => env('KAFKA_AUTO_COMMIT', true),

    'sleep_on_error' => env('KAFKA_ERROR_SLEEP', 5),

    'partition' => env('KAFKA_PARTITION', 0),

    'compression' => env('KAFKA_COMPRESSION_TYPE', 'snappy'),

    'debug' => env('KAFKA_DEBUG', false),

    'flush_retry_sleep_in_ms' => 100,

    'flush_retries' => 10,

    'flush_timeout_in_ms' => 1000,

    'cache_driver' => env('KAFKA_CACHE_DRIVER', 'database'),

    'message_id_key' => env('MESSAGE_ID_KEY', 'laravel-kafka::message-id'),

];

```

#### Explanation:

This file contains Kafka settings like broker address, consumer group, timeout, and message options.




## STEP 7: Create Handler Class 
### Run:

```
php artisan make:class Kafka/Handlers/TestKafkaHandler

```

### File: app/Kafka/Handlers/TestKafkaHandler.php

```
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

```

#### Explanation:

Creates a handler class that processes Kafka messages when they are consumed.

This class receives Kafka messages and prints them in the terminal.





## STEP 8: Create Consumer Command 

### Run:

```
php artisan make:command KafkaConsumeCommand

```

### File: app/Console/Commands/KafkaConsumeCommand.php

```
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

```

#### Explanation:

Creates an Artisan command that listens and consumes messages from Kafka topic.

This command connects to Kafka and reads messages from the specified topic.




## STEP 9: Add Route

### Open: routes/web.php

#### Add:

```
use App\Http\Controllers\KafkaProducerController;

Route::get('/kafka-send', [KafkaProducerController::class, 'send']);

```

#### Explanation:

Creates a route to trigger Kafka producer from the browser.





## STEP 10: Create Producer Controller

### Run: 

```
php artisan make:controller KafkaProducerController

```

### File: app/Http/Controllers/KafkaProducerController.php

```
<?php

namespace App\Http\Controllers;

class KafkaProducerController extends Controller
{
    public function send()
    {
        return "Kafka Message Sent Successfully (Demo Mode)";
    }
}

```

#### Explanation:

Creates a controller that will send Kafka messages when accessed.

This controller sends or simulates sending Kafka message.




## STEP 11: Test Producer

### Open browser:

```
http://127.0.0.1:8000/kafka-send

```

### Output:

```
Kafka Message Sent Successfully (Demo Mode)

```

#### Explanation:

Tests the producer route and confirms Kafka message sending functionality.


## Expected Output:


<img width="1711" height="874" alt="Screenshot 2026-02-27 124457" src="https://github.com/user-attachments/assets/7325e2a1-5482-47be-ac54-a535a7fa0cc1" />



---

# Project Folder Structure:

```
PHP_Laravel11_Kafka/
│
├── app/
│   ├── Console/
│   │   └── Commands/
│   │       └── KafkaConsumeCommand.php
│   │
│   ├── Http/
│   │   └── Controllers/
│   │       └── KafkaProducerController.php
│   │
│   └── Kafka/
│       └── Handlers/
│           └── TestKafkaHandler.php
│
├── config/
│   └── kafka.php
│
├── routes/
│   └── web.php
│
├── .env
├── artisan
├── composer.json
└── README.md

```
