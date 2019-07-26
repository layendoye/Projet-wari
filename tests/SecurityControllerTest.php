<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class SecurityControllerTest extends WebTestCase
{
    public function testInscriptionUtilisateurok()
    {
        $token = new UsernamePasswordToken('admin', null, 'api', ['ROLE_Super_admin']);
        $client = static::createClient([],[ 
                'PHP_AUTH_USER' => 'Abdou' ,
                'PHP_AUTH_PW'   => 'azerty' ,
            ]);
        $crawler = $client->request('POST', '/api/inscription',[],[],['CONTENT_TYPE'=>"application/json"],
            '{
                "Nom":"Awa ciss",
                "username": "awaciss2",
                "password": "azerty",
                "confirmPassword": "azerty",
                "Entreprise": 3,
                "Email":"evawa2@gmail.com",
                "Telephone": 7785446467,
                "Nci":"1751 1500 07854622",
                "Profil": 2
            }'
        );
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(201,$client->getResponse()->getStatusCode());
    }
    public function testInscriptionUtilisateurk01()
    {
        $token = new UsernamePasswordToken('admin', null, 'api', ['ROLE_Super_admin']);
        $client = static::createClient([],[ 
                'PHP_AUTH_USER' => 'Abdou' ,
                'PHP_AUTH_PW'   => 'azerty' ,
            ]);
        $crawler = $client->request('POST', '/api/inscription',[],[],['CONTENT_TYPE'=>"application/json"],
            '{
                "Nom":"aaa",
                "username": "qq",
                "password": "azerty",
                "confirmPassword": "azerty",
                "Entreprise": 3,
                "Email":"www@gmail.com",
                "Telephone": 778544647,
                "Nci":"17511500078546",
                "Profil": 4
            }'
        );
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(409,$client->getResponse()->getStatusCode());
    }
    public function testInscriptionUtilisateurk02()
    {
        $token = new UsernamePasswordToken('admin', null, 'api', ['ROLE_Super_admin']);
        $client = static::createClient([],[ 
                'PHP_AUTH_USER' => 'Abdou' ,
                'PHP_AUTH_PW'   => 'azerty' ,
            ]);
        $crawler = $client->request('POST', '/api/inscription',[],[],['CONTENT_TYPE'=>"application/json"],
            '{
                "Nom":"aaa2",
                "username": "qq2",
                "password": "azerty",
                "confirmPassword": "azerty",
                "Entreprise": 3,
                "Email":"www2@gmail.com",
                "Telephone": 778544642,
                "Nci":"175115000785462",
                "Profil": 5
            }'
        );
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(409,$client->getResponse()->getStatusCode());
    }
    public function testInscriptionUtilisateurk03()
    {
        $token = new UsernamePasswordToken('admin', null, 'api', ['ROLE_Super_admin']);
        $client = static::createClient([],[ 
                'PHP_AUTH_USER' => 'qq3' ,
                'PHP_AUTH_PW'   => 'azerty' ,
            ]);
        $crawler = $client->request('POST', '/api/inscription',[],[],['CONTENT_TYPE'=>"application/json"],
            '{
                "Nom":"aaa3",
                "username": "qq33",
                "password": "azerty",
                "confirmPassword": "azerty",
                "Entreprise": 3,
                "Email":"www333@gmail.com",
                "Telephone": 7785446433,
                "Nci":"17511500078546333",
                "Profil": 1
            }'
        );
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(409,$client->getResponse()->getStatusCode());
    }
}
