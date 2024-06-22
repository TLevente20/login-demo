<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use App\Auth;

final class TokenValidationTest extends TestCase
{

    public function testValidToken()
    {
        $validToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE3MTkwODk0MjUsImV4cCI6MTcxOTA4OTQ1NSwic3ViIjoiMSJ9.R8HDZz4L8Zqx4G3N6byPATQ124l0yFO6HCal3UKeYgA'; // Replace with a valid JWT token

        $expectedData = [
            'iss' => 'localhost',
            'iat' => 1719089425,
            'exp' => 1719089455,
            'sub' => '1'
        ];

        // Mock or set up any dependencies like Config, JWTManager, etc., as needed

        // Call the validateToken method with the valid token
        $result = Auth::validateToken($validToken);
        $decodedResult = json_encode($result);
        

        // Assert that the result indicates success
        $this->assertEquals(['status' => 'success', 'data' => $expectedData], $decodedResult);

    }

    public function testInvalidToken()
    {
        $invalidToken = 'invalid_jwt_token_here'; // Replace with an invalid JWT token

        // Mock or set up any dependencies

        // Call the validateToken method with the invalid token
        $result = Auth::validateToken($invalidToken);

        // Assert that the result indicates failure (error status)
        $this->assertEquals(['status' => 'error', 'message' => 'Invalid token'], $result);
    }

    public function testMissingToken()
    {
        $missingToken = null;

        // Mock or set up any dependencies

        // Call the validateToken method with a missing token
        $result = Auth::validateToken($missingToken);

        // Assert that the result indicates failure (error status)
        $this->assertEquals(['status' => 'error', 'message' => 'Token is missing'], $result);
    }
}