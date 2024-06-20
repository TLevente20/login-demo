<?php

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

//Run request handeling in src/Router.php
Router::handleRequest();