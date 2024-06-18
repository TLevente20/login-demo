<?php
use App\Lib\App;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/App/routes/web.php';

// Using App class method to start loggers
App::runLoggers();

