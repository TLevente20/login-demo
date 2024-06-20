<?php namespace App\Models;

use mysqli;

/*
For testing purposes i've declared the following user:

email => test@gmail.com
password => password
hash => $2y$10$wVEN9JkscWgLlOgJWnREse.WxHjAcakzekVbz0uvN4n.VygV57i0C
 */

class User{
    protected $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }

    public function findByEmailAndPassword($email, $password) {
        // Sanitize input to prevent SQL injection
        $email = $this->conn->real_escape_string($email);
        
        // Query to get the hashed password for the given email
        $sql = "SELECT * FROM users WHERE email = '{$email}' LIMIT 1";
        $result = $this->conn->query($sql);
    
        if ($result && $result->num_rows > 0) {

            $user = $result->fetch_assoc();
    
            // Verify the provided password against the stored hashed password
            if (password_verify($password, $user['password'])) {

                // Password is correct, return user data
                return $user;
            } else {

                // Password is incorrect
                return false;
            }
        } else {

            // User not found
            return false;
        }
    }
    
}