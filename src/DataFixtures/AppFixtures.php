<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $user=new Utilisateur();
        // $user->setUsername()
        //      ->setRoles(['ROLE_utilisateur'])
        //      ->setPassword('')
        //      ->setUsername()
        //      ->setUsername()
        //      ->setUsername()
        //      ->setUsername(); 

        $manager->flush();
    }
}
