<?php namespace App;


// Get config values

class Config
{
    private static $config;

    public static function get($key, $default = null)
    {
        if (is_null(self::$config)) {
            self::$config = require_once(__DIR__.'/../config/config.php');
        }

        return !empty(self::$config[$key])?self::$config[$key]:$default;
    }
}