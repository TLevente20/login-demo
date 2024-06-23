<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use App\Auth;
use App\Config;
use Firebase\JWT\JWT;

final class TokenValidationTest extends TestCase
{

    public function testValidToken()
    {
        //Arrange (set up a custom jwt token)
        $userId = 1;
        $payload = [
            'iss' => 'localhost',
            'iat' => time(),
            'exp' => time() + 3600,
            'sub' => $userId
        ];
        $secret = Config::get('JWT_SECRET_KEY');

        $token = JWT::encode($payload, $secret, 'HS256');


        // Act (Call validate token function)
        $result = Auth::validateToken($token);


        // Assert (assert $result has the correct data)
        $this->assertIsArray($result);
        $this->assertArrayHasKey('iss', $result);
        $this->assertEquals('localhost', $result['iss']);
        $this->assertArrayHasKey('sub', $result);
        $this->assertEquals($userId, $result['sub']);
    }

    public function testInvalidTokenFormat()
    {
        // This token is surely not valid
        $invalidToken = 'Not.a.token';


        // Call validate token function
        $result = Auth::validateToken($invalidToken);

        // Assert that the result is false
        $this->assertFalse($result);
    }



}