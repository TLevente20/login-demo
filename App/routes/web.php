<?php
use App\Lib\Router;

Router::get('/', function () {
    echo 'We are home';
});

Router::get('/login', function () {
    include __DIR__ . '/../views/login.html';
});


