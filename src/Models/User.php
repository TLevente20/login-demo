<?php namespace App;

use mysqli;

class User{
    protected $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }

    public function findByEmailAndPassword($email, $password) {
        
        // Sanitize input to prevent SQL injection
        $email = $this->conn->real_escape_string($email);
        $password = $this->conn->real_escape_string($password);

        // Query to check if email and password combination exists
        $sql = "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}' LIMIT 1";
        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {
            // User found
            return $result->fetch_assoc();
        } else {
            // User not found
            return false;
        }
    }
}