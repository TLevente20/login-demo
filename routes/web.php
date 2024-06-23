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
    Auth::refreshToken();
});

Router::post('/validate-token', function ($request, $response) {
    Auth::validateLogin();
});

//Run request handeling in src/Router.php
Router::handleRequest();