<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndexControllerTest extends WebTestCase
{
    public function testLoginCorrectData() : void
    {

        $client = static::createClient();
        $crawler = $client->request('POST', '/login', [
            'login'    => 'alex',
            'password' => 'password',
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello');
    }

    /**
     * @dataProvider getLoginPass
     */
    public function testLoginIncorrectData()
    {

    }

    public function getLoginPass()
    {

        return [
            [
                'alex',
                'password',
            ],
            [
                'alex2!@#$%&%&*&*+_)(^%$#@@',
                'password2',
            ],
        ];
    }
}
