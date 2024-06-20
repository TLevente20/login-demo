<?php namespace App;
use App\Router;

Router::get('/', function ($request,$response) {
    echo 'We are home';
});

Router::get('/login', function ($request,$response) {
    include __DIR__ . '/../public/views/login.html';
});

Router::post('/login',function ($request,$response) {
    error_log("puutting");
});

//Run request handeling in src/Router.php
Router::handleRequest();