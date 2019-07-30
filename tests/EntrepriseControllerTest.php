<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use PHPUnit\Framework\Exception;
//use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class EntrepriseControllerTest extends WebTestCase
{
    public function testShow(){
        $client = static::createClient();
        $client->request('GET', '/22');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }
}

?>