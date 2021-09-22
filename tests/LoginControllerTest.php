<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class LoginControllerTest extends ApiTestCase
{
    public function testSomething() : void
    {

        $response = static::createClient()->request('POST', '/login');


        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            'result' => true,
        ]);
    }
}
