<?php namespace App;


class Config
{
    private static $config;

    // Get config values
    public static function get($key, $default = null)
    {
        if (is_null(self::$config)) {
            self::$config = require_once(__DIR__.'/../config/config.php');
        }

        return !empty(self::$config[$key])?self::$config[$key]:$default;
    }
}