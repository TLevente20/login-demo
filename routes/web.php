<?php

use App\Router;
use App\Controllers\LoginController;
use App\JWTManager;

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
    JWTManager::refreshToken($request);
});

//Run request handeling in src/Router.php
Router::handleRequest();