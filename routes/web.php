<?php namespace App;
use App\Router;

Router::get('/', function () {
    echo 'We are home';
});

Router::get('/login', function () {
    include __DIR__ . '/../public/views/login.html';
});


