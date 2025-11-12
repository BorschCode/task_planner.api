<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLogin(): void
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/api/login', [], [], [
            'CONTENT_TYPE' => 'application/json',
        ], json_encode([
            'email' => 'test@user.email',
            'password' => '123'
        ]));

        $this->assertResponseStatusCodeSame(200);
        $response = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('token', $response);
    }

    public function testLoginWithInvalidCredentials(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/login', [], [], [
            'CONTENT_TYPE' => 'application/json',
        ], json_encode([
            'email' => 'invalid@email.com',
            'password' => 'wrongpassword'
        ]));

        $this->assertResponseStatusCodeSame(401);
    }
}