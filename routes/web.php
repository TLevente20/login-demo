<?php

use App\Auth;
use App\Router;
use App\Controllers\LoginController;


Router::get('/', function ($request,$response) {
    LoginController::index();
});

Router::get('/login', function ($request,$response) {
    LoginController::showLogin();
});

Router::post('/login',function ($request,$response) {

    LoginController::login($request->getBody());
});

Router::post('/refresh-token', function ($request, $response) {
    Auth::refreshToken($request);
});

Router::post('/validate-token', function ($request, $response) {

    $headers = getallheaders();

    // Extract the token from the Authorization header
    if (isset($headers['Authorization'])) {
        $authHeader = $headers['Authorization'];
        $token = str_replace('Bearer ', '', $authHeader);
    } else {

        // Handle the case where no token is provided
        $token = null;

    }
    $validatedToken = Auth::validateToken($token);
    
    if ($validatedToken) {

        // Token is valid
        echo json_encode(['status' => 'success']);

    } else {

        // Return an error response
        http_response_code(401);
    }
});

//Run request handeling in src/Router.php
Router::handleRequest();