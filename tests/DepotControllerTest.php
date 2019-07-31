<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DepotControllerTest extends WebTestCase
{
    public function testdepot()
    {
        $client = static::createClient([],[ 
            'PHP_AUTH_USER' => 'Abdou' ,
            'PHP_AUTH_PW'   => 'azerty'
        ]);
        $crawler = $client->request('GET', '/api/depot/entreprise',[],[],['CONTENT_TYPE'=>"application/json"],
        
        
        '{
            "Entreprise": 1,
            "Montant": 2000000
        }'

    );
        $rep=$client->getResponse(); 
        $this->assertSame(201,$client->getResponse()->getStatusCode());
        
    }

}

