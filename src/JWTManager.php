<?php namespace App;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class JWTManager{

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
    
    public static function validateToken($token) {
    
        $secret = Config::get('JWT_SECRET_KEY');
        try {
            $decoded = JWT::decode($token, new Key($secret, 'HS256'));
            return (array)$decoded; // Return decoded token as array
        } catch (Exception $e) {
            return false; // Token is invalid
        }
    }

    public static function refreshToken($request) {
        $refreshToken = $request['refresh_token'];

        // Validate refresh token
        $decoded = JWTManager::validateToken($refreshToken);

        if ($decoded) {
            $newJWT = JWTManager::generateJWT($decoded['sub']); // Use user ID from the decoded token

            echo json_encode([
                'status' => 'success',
                'jwt' => $newJWT
            ]);
            
        } else {
            http_response_code(401);
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid refresh token'
            ]);
        }
    }
}
