<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class SecurityControllerTest extends WebTestCase
{
    public function testInscriptionUtilisateurok1()
    {
        $token = new UsernamePasswordToken('admin', null, 'api', ['ROLE_Super_admin']);
        $client = static::createClient([],[ 
                'PHP_AUTH_USER' => 'Abdou' ,
                'PHP_AUTH_PW'   => 'azerty' ,
            ]);
        $crawler = $client->request('POST', '/api/inscription',[],[],['CONTENT_TYPE'=>"application/json"],
            '{
                "Nom":"Awa ciss",
                "username": "awaciss3",
                "password": "azerty",
                "confirmPassword": "azerty",
                "Entreprise": 3,
                "Email":"evawa3@gmail.com",
                "Telephone": 77854999,
                "Nci":"1751 1500 074622",
                "Profil": 2
            }'
        );
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(201,$client->getResponse()->getStatusCode());
    }
    public function testInscriptionUtilisateurok2()
    {
        $token = new UsernamePasswordToken('admin', null, 'api', ['ROLE_Super_admin']);
        $client = static::createClient([],[ 
                'PHP_AUTH_USER' => 'Abdou' ,
                'PHP_AUTH_PW'   => 'azerty' ,
            ]);
        $crawler = $client->request('POST', '/api/inscription',[],[],['CONTENT_TYPE'=>"application/json"],
            '{
                "Nom":"Abdu",
                "username": "abxx",
                "password": "azerty",
                "confirmPassword": "azerty",
                "Entreprise": 3,
                "Email":"abd8x@gmail.com",
                "Telephone": 775543,
                "Nci":"1751 1500 07",
                "Profil": 1
            }'
        );
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(201,$client->getResponse()->getStatusCode());
    }
    public function testInscriptionUtilisateurok3()
    {
        $token = new UsernamePasswordToken('admin', null, 'api', ['ROLE_Super_admin']);
        $client = static::createClient([],[ 
                'PHP_AUTH_USER' => 'Abdou' ,
                'PHP_AUTH_PW'   => 'azerty' ,
            ]);
        $crawler = $client->request('POST', '/api/inscription',[],[],['CONTENT_TYPE'=>"application/json"],
            '{
                "Nom":"A",
                "username": "layy",
                "password": "azerty",
                "confirmPassword": "azerty",
                "Entreprise": 3,
                "Email":"abdy8@gmail.com",
                "Telephone": 775541,
                "Nci":"1751 15006 07",
                "Profil": 3
            }'
        );
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(201,$client->getResponse()->getStatusCode());
    }
    public function testInscriptionUtilisateurok4()
    {
        $token = new UsernamePasswordToken('admin', null, 'api', ['ROLE_Super_admin']);
        $client = static::createClient([],[ 
                'PHP_AUTH_USER' => 'awac' ,
                'PHP_AUTH_PW'   => 'azerty' ,
            ]);
        $crawler = $client->request('POST', '/api/inscription',[],[],['CONTENT_TYPE'=>"application/json"],
            '{
                "Nom":"Az",
                "username": "layye",
                "password": "azerty",
                "confirmPassword": "azerty",
                "Entreprise": 3,
                "Email":"abdyr82@gmail.com",
                "Telephone": 775547412,
                "Nci":"17510069907",
                "Profil": 4
            }'
        );
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(201,$client->getResponse()->getStatusCode());
    }
    public function testInscriptionUtilisateurok5()
    {
        $token = new UsernamePasswordToken('admin', null, 'api', ['ROLE_Super_admin']);
        $client = static::createClient([],[ 
                'PHP_AUTH_USER' => 'awac' ,
                'PHP_AUTH_PW'   => 'azerty' ,
            ]);
        $crawler = $client->request('POST', '/api/inscription',[],[],['CONTENT_TYPE'=>"application/json"],
            '{
                "Nom":"Az",
                "username": "laayye",
                "password": "azerty",
                "confirmPassword": "azerty",
                "Entreprise": 3,
                "Email":"abdy872@gmail.com",
                "Telephone": 77570712,
                "Nci":"17510607",
                "Profil": 5
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
    public function testInscriptionUtilisateurk04()
    {
        $token = new UsernamePasswordToken('admin', null, 'api', ['ROLE_Super_admin']);
        $client = static::createClient([],[ 
                'PHP_AUTH_USER' => 'awaciss2' ,
                'PHP_AUTH_PW'   => 'azerty' ,
            ]);
        $crawler = $client->request('POST', '/api/inscription',[],[],['CONTENT_TYPE'=>"application/json"],
            '{
                "Nom":"aaa3",
                "username": "ss33",
                "password": "azerty",
                "confirmPassword": "azerty",
                "Entreprise": 3,
                "Email":"wwws333@gmail.com",
                "Telephone": 77446433,
                "Nci":"175178546333",
                "Profil": 2
            }'
        );
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(409,$client->getResponse()->getStatusCode());
    }
    public function testInscriptionUtilisateurk05()
    {
        $token = new UsernamePasswordToken('admin', null, 'api', ['ROLE_Super_admin']);
        $client = static::createClient([],[ 
                'PHP_AUTH_USER' => 'awaciss2' ,
                'PHP_AUTH_PW'   => 'azerty' ,
            ]);
        $crawler = $client->request('POST', '/api/inscription',[],[],['CONTENT_TYPE'=>"application/json"],
            '{
                "Nom":"aaa3",
                "username": "ssss7",
                "password": "azerty",
                "confirmPassword": "azerty",
                "Entreprise": 3,
                "Email":"wwwds333@gmail.com",
                "Telephone": 77456433,
                "Nci":"17517856333",
                "Profil": 3
            }'
        );
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(409,$client->getResponse()->getStatusCode());
    }
    public function testInscriptionUtilisateurk06()
    {
        $token = new UsernamePasswordToken('admin', null, 'api', ['ROLE_Super_admin']);
        $client = static::createClient([],[ 
                'PHP_AUTH_USER' => 'awaciss2' ,
                'PHP_AUTH_PW'   => 'azerty' ,
            ]);
        $crawler = $client->request('POST', '/api/inscription',[],[],['CONTENT_TYPE'=>"application/json"],
            '{
                "Nom":"aaooo",
                "username": "sssoos7",
                "password": "azerty",
                "confirmPassword": "azerty",
                "Entreprise": 3,
                "Email":"wwwdos333@gmail.com",
                "Telephone": "ok",
                "Nci":"175171856333",
                "Profil": 5
            }'
        );
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(200,$client->getResponse()->getStatusCode());
    }
    /**/
}
