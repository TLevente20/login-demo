<?php
// The config key => values
return [
 'LOG_PATH' => __DIR__ . '../../logs',

 'DB_SERVERNAME' => '127.0.0.1',
 'DB_USERNAME' => 'root',
 "DB_PASSWORD" => "",

 'JWT_SECRET_KEY' => 'secretkeyjwt',
 'JWT_ISSUER' => 'localhost',
 'JWT_EXPIRATION_TIME' => 30,
 'JWT_REFRESH_EXPIRATION_TIME'=> 3600
];
