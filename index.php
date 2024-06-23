<?php namespace App;
use App\App;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/routes/web.php';
require __DIR__ . '/config/database.php';

// Using App class method to start loggers
App::runLoggers();