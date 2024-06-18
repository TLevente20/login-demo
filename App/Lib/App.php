<?php namespace App\Lib;

// Initializing app systems

class App
{
    // Create loggers 
    public static function runLoggers()
    {
        Logger::enableSystemLogs();
    }
}