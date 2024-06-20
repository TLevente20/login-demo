<?php

use App\Config;
use App\Logger;

$servername = Config::get('DB_SERVERNAME');
$username = Config::get('DB_USERNAME');
$password = Config::get('DB_PASSWORD');


$logger = Logger::getInstance();

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  $logger->info("DB failed to connect". $conn->connect_error);
}


// Use database
$sql = "USE logindemo";
if ($conn->query($sql) === TRUE) {
    $logger->info('BD connected succesfully');
} else {
  echo "Error used database: " . $conn->error;
}

