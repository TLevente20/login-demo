<?php namespace App;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

//By: TLevente20

class ManageJWT{

    //Generate a fresh JWT token to a user with $userID
    public static function generateJWT($userId) {

        //Fetch data from config
        $issuer = Config::get('JWT_ISSUER');
        $expTime = Config::get('JWT_EXPIRATION_TIME');
        $secret = Config::get('JWT_SECRET_KEY');
    
        //Setup payload
        $payload = [
            'iss' => $issuer, // Issuer
            'iat' => time(), // Issued at
            'exp' => time() + $expTime, // Expiration time
            'sub' => $userId // Subject (user ID)
        ];
    
        return JWT::encode($payload, $secret, 'HS256');
    }
    

    //Generate a fresh refresh token to a user with $userID
    //(refresh tokens are expire much later, it is used for refreshing JWT tokens without logging in again)
    public static function generateRefreshToken($userId) {
    
        //Fetch data from config
        $issuer = Config::get('JWT_ISSUER');
        $expTime = Config::get('JWT_REFRESH_EXPIRATION_TIME');
        $secret = Config::get('JWT_SECRET_KEY');
    
        $payload = [
            'iss' => $issuer, // Issuer
            'iat' => time(), // Issued at
            'exp' => time() + $expTime, // REFRESH Expiration time
            'sub' => $userId // Subject (user ID)
        ];
    
        return JWT::encode($payload, $secret, 'HS256');
    }
    
    //Check if a JWT is valid
    public static function validateToken($token) {
    
        $secret = Config::get('JWT_SECRET_KEY');
        try {
            $decoded = JWT::decode($token, new Key($secret, 'HS256'));
            
            // Return decoded token as array
            return (array)$decoded;
        } catch (Exception $e) {

            // Token is invalid
            //error_log($e);
            return false;
        }
    }

    //If a user has a valid RefreshToken, generate a new JWT for them
    public static function refreshToken($refreshToken) {

        // Validate refresh token
        $decodedRefresh = ManageJWT::validateToken($refreshToken);
        if ($decodedRefresh){
            
            // Use user ID from the decoded token
            $newJWT = ManageJWT::generateJWT($decodedRefresh['sub']); 
            
            echo json_encode([
                'status' => 'success',
                'token' => $newJWT,
            ]);
        }
        else{
            
            // Token is invalid
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid refresh token'
            ]);
            http_response_code(401);
        }
    }
}