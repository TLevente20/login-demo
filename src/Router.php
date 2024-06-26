<?php

namespace App;

class Router
{
    //Make an Array of all declared routes
    protected static $routes = [];

    public static function get($route, $callback)
    {
        self::$routes['GET'][$route] = $callback;
    }

    public static function post($route, $callback)
    {
        self::$routes['POST'][$route] = $callback;
    }

    //The method that routes/web.php uses to match URI and handle the request
    public static function handleRequest()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        if (isset(self::$routes[$method][$route])) {
            $callback = self::$routes[$method][$route];
            $request = new Request($_REQUEST); 
            $response = new Response();
            $callback($request, $response);
        } else {
            
            // Handle 404 Not Found
            http_response_code(404);
            echo "404 Not Found";
        }
    }
}
