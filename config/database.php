<?php
use App\Logger;

$servername = "127.0.0.1";
$username = "root";
$password = "";



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

?>

