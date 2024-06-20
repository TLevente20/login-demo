<?php namespace App\Controllers;

use App\Models\User;
use App\Logger;
use App\JWTManager;


class LoginController{

    //Show the home page
    public static function index(){
        include 'public\views\home.html';
    }

    //Show the login page
    public static function showLogin(){
        include 'public\views\login.html';
    }

    //Logging in
    public static function login($loginData){

        $logger = Logger::getInstance();

        //Connecting to MySql
        include_once 'config\database.php';

        //Looking for a User with the matching credencials
        $model = new User($conn);

        // Ensure response is JSON
        header('Content-Type: application/json');

        $user = $model->findByEmailAndPassword($loginData['email'], $loginData['password']);

        if ($user) {
            //The user is found creating a response
            $logger->info("Logging in is succesful. Response code: 200 Email:". $loginData['email']);
            http_response_code(200);

            //Generate JSW token for user
            $jwt = JWTManager::generateJWT($user['id']);
            $refreshToken = JWTManager::generateRefreshToken($user['id']);

            echo json_encode([
                'status' => 'success',
                'message' => 'Login successful',
                'redirect' => '/',
                'jwt' => $jwt,
                'refresh_token' => $refreshToken
            ]);

        } else {
            $logger->info("Logging in has failed due to invalid credencials. Response code: 401");
            http_response_code(401);
        }
    }
}
