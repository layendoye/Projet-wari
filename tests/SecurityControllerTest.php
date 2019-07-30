<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{ 
    public function testInscriptionUtilisateurok1()
    {
        $client = static::createClient([],[ 
                'PHP_AUTH_USER' => 'Abdou' ,
                'PHP_AUTH_PW'   => 'azerty'
            ]);
        $crawler = $client->request('POST', '/api/inscription',[],[],['CONTENT_TYPE'=>"application/json"],
            '{
                "Nom":"test1",
                "username": "test1",
                "password": "azerty",
                "confirmPassword": "azerty",
                "Entreprise": 3,
                "Email":"test1@gmail.com",
                "Telephone": 7700001,
                "Nci":"7700001",
                "Profil": 2
            }'
        );
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(201,$client->getResponse()->getStatusCode());
    }
    
    public function testInscriptionUtilisateurok2()
    {
        $client = static::createClient([],[ 
                'PHP_AUTH_USER' => 'Abdou' ,
                'PHP_AUTH_PW'   => 'azerty' ,
            ]);
        $crawler = $client->request('POST', '/api/inscription',[],[],['CONTENT_TYPE'=>"application/json"],
            '{
                "Nom":"test2",
                "username": "test2",
                "password": "azerty",
                "confirmPassword": "azerty",
                "Entreprise": 3,
                "Email":"test2@gmail.com",
                "Telephone": 7700002,
                "Nci":"7700002",
                "Profil": 1
            }'
        );
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(201,$client->getResponse()->getStatusCode());
    }
    public function testInscriptionUtilisateurok3()
    {
        
        $client = static::createClient([],[ 
                'PHP_AUTH_USER' => 'Abdou' ,
                'PHP_AUTH_PW'   => 'azerty' ,
            ]);
        $crawler = $client->request('POST', '/api/inscription',[],[],['CONTENT_TYPE'=>"application/json"],
            '{
                "Nom":"test3",
                "username": "test3",
                "password": "azerty",
                "confirmPassword": "azerty",
                "Entreprise": 3,
                "Email":"test3@gmail.com",
                "Telephone": 7700003,
                "Nci":"7700003",
                "Profil": 3
            }'
        );
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(201,$client->getResponse()->getStatusCode());
    }
    public function testInscriptionUtilisateurok4()
    {
        
        $client = static::createClient([],[ 
                'PHP_AUTH_USER' => 'admPrincipale1' ,
                'PHP_AUTH_PW'   => 'azerty' ,
            ]);
        $crawler = $client->request('POST', '/api/inscription',[],[],['CONTENT_TYPE'=>"application/json"],
            '{
                "Nom":"test4",
                "username": "test4",
                "password": "azerty",
                "confirmPassword": "azerty",
                "Entreprise": 3,
                "Email":"test4@gmail.com",
                "Telephone": 7700004,
                "Nci":"7700004",
                "Profil": 4
            }'
        );
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(201,$client->getResponse()->getStatusCode());
    }
    public function testInscriptionUtilisateurok5()
    {
        
        $client = static::createClient([],[ 
                'PHP_AUTH_USER' => 'admPrincipale1' ,
                'PHP_AUTH_PW'   => 'azerty' ,
            ]);
        $crawler = $client->request('POST', '/api/inscription',[],[],['CONTENT_TYPE'=>"application/json"],
            '{
                "Nom":"test5",
                "username": "test5",
                "password": "azerty",
                "confirmPassword": "azerty",
                "Entreprise": 3,
                "Email":"test5@gmail.com",
                "Telephone": 7700005,
                "Nci":"7700005",
                "Profil": 5
            }'
        );
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(201,$client->getResponse()->getStatusCode());
    }
    public function testInscriptionUtilisateurk01()
    {
        
        $client = static::createClient([],[ 
                'PHP_AUTH_USER' => 'Abdou' ,
                'PHP_AUTH_PW'   => 'azerty' ,
            ]);
        $crawler = $client->request('POST', '/api/inscription',[],[],['CONTENT_TYPE'=>"application/json"],
            '{
                "Nom":"test6",
                "username": "test6",
                "password": "azerty",
                "confirmPassword": "azerty",
                "Entreprise": 3,
                "Email":"test6@gmail.com",
                "Telephone": 7700006,
                "Nci":"7700006",
                "Profil": 4
            }'
        );
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(409,$client->getResponse()->getStatusCode());
    }
    public function testInscriptionUtilisateurk02()
    {
        
        $client = static::createClient([],[ 
                'PHP_AUTH_USER' => 'caissier1' ,
                'PHP_AUTH_PW'   => 'azerty' ,
            ]);
        $crawler = $client->request('POST', '/api/inscription',[],[],['CONTENT_TYPE'=>"application/json"],
            '{
                "Nom":"test7",
                "username": "test7",
                "password": "azerty",
                "confirmPassword": "azerty",
                "Entreprise": 3,
                "Email":"test7@gmail.com",
                "Telephone": "ok",
                "Nci":"7700007",
                "Profil": 5
            }'
        );
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(200,$client->getResponse()->getStatusCode());
    }
    public function testInscriptionUtilisateurk03()
    {
        
        $client = static::createClient([],[ 
                'PHP_AUTH_USER' => 'Abdou' ,
                'PHP_AUTH_PW'   => 'azerty' ,
            ]);
        $crawler = $client->request('POST', '/api/inscription',[],[],['CONTENT_TYPE'=>"application/json"],
            '{
                "Nom":"test8",
                "username": "test8",
                "password": "azerty",
                "confirmPassword": "azerty",
                "Entreprise": 3,
                "Email":"test8@gmail.com",
                "Telephone": 7700008,
                "Nci":"7700008",
                "Profil": 5
            }'
        );
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(409,$client->getResponse()->getStatusCode());
    }
    public function testInscriptionUtilisateurk04()
    {
        
        $client = static::createClient([],[ 
                'PHP_AUTH_USER' => 'utilisateur1' ,
                'PHP_AUTH_PW'   => 'azerty' ,
            ]);
        $crawler = $client->request('POST', '/api/inscription',[],[],['CONTENT_TYPE'=>"application/json"],
            '{
                "Nom":"test9",
                "username": "test9",
                "password": "azerty",
                "confirmPassword": "azerty",
                "Entreprise": 3,
                "Email":"test9@gmail.com",
                "Telephone": 7700009,
                "Nci":"7700009",
                "Profil": 1
            }'
        );
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(409,$client->getResponse()->getStatusCode());
    }
    public function testInscriptionUtilisateurk05()
    {
        
        $client = static::createClient([],[ 
                'PHP_AUTH_USER' => 'caissier1' ,
                'PHP_AUTH_PW'   => 'azerty' ,
            ]);
        $crawler = $client->request('POST', '/api/inscription',[],[],['CONTENT_TYPE'=>"application/json"],
            '{
                "Nom":"test10",
                "username": "test10",
                "password": "azerty",
                "confirmPassword": "azerty",
                "Entreprise": 3,
                "Email":"test10@gmail.com",
                "Telephone": 77000010,
                "Nci":"77000010",
                "Profil": 2
            }'
        );
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(409,$client->getResponse()->getStatusCode());
    }
    public function testInscriptionUtilisateurk06()
    {
        
        $client = static::createClient([],[ 
                'PHP_AUTH_USER' => 'caissier1' ,
                'PHP_AUTH_PW'   => 'azerty' ,
            ]);
        $crawler = $client->request('POST', '/api/inscription',[],[],['CONTENT_TYPE'=>"application/json"],
            '{
                "Nom":"test11",
                "username": "test11",
                "password": "azerty",
                "confirmPassword": "azerty",
                "Entreprise": 3,
                "Email":"test11@gmail.com",
                "Telephone": 77000011,
                "Nci":"77000011",
                "Profil": 3
            }'
        );
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(409,$client->getResponse()->getStatusCode());
    }
}
 