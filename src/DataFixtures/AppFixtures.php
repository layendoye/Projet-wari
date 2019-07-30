<?php

namespace App\DataFixtures;

use App\Entity\Profil;
use App\Entity\Entreprise;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $motDePass='$2y$13$ABDZmhTxOlcf4HHbTC3BJeNFZuL/ad/uMTdZgCJZLYYQcSQP0LTKG';
        $actif='Actif';
        $profilSup=new Profil();
        $profilSup->setLibelle('Super-admin');
        $manager->persist($profilSup);
        
        $profilCaiss=new Profil();
        $profilCaiss->setLibelle('Caissier');
        $manager->persist($profilCaiss);
        
        $profilAdP=new Profil();
        $profilAdP->setLibelle('admin-Principal');
        $manager->persist($profilAdP);
        
        $profilAdm=new Profil();
        $profilAdm->setLibelle('admin');
        $manager->persist($profilAdm);
        
        $profilUtil=new Profil();
        $profilUtil->setLibelle('utilisateur');
        $manager->persist($profilUtil);
        

        $wari=new Entreprise();
        $wari->setNumeroCompte(strval(rand(150000000,979999999)))
                    ->setRaisonSociale('Wari')
                    ->setNinea(strval(rand(150000000,979999999)))
                    ->setAdresse('Mermoz')
                    ->setSolde(1000000)
                    ->setStatus($actif);
        $manager->persist($wari);
        $SupUser=new Utilisateur();
        $SupUser->setUsername('Abdou')
             ->setRoles(['ROLE_Super-admin'])
             ->setPassword($motDePass)
             ->setConfirmPassword($motDePass)
             ->setEntreprise($wari)
             ->setNom('Abdoulaye Ndoye')
             ->setEmail('layendoyesn@gmail.com')
             ->setTelephone(rand(770000000,779999999))
             ->setNci(strval(rand(150000000,979999999)))
             ->setStatus($actif)
             ->setProfil($profilSup); 
        $manager->persist($SupUser);

        $faker = \Faker\Factory::create('fr_FR');
        for($i=0;$i<=20;$i++){
            $entreprise=new Entreprise();
            $entreprise->setNumeroCompte(strval(rand(150000000,979999999)))
                        ->setRaisonSociale($faker->company)
                        ->setNinea(strval(rand(150000000,979999999)))
                        ->setAdresse($faker->streetAddress)
                        ->setSolde(rand(1000000,10000000))
                        ->setStatus($actif);
            $manager->persist($entreprise);
            
            
            
            for($j=1;$j<7;$j++){
                $user=new Utilisateur();
                $user->setUsername($faker->userName)
                    ->setPassword($motDePass)
                    ->setConfirmPassword($motDePass)
                    ->setEntreprise($entreprise)
                    ->setNom($faker->name)
                    ->setEmail($faker->email)
                    ->setTelephone(rand(770000000,779999999))
                    ->setNci(strval(rand(150000000,979999999)))
                    ->setStatus($actif);

                if($j==1){
                    
                    $user->setProfil($profilAdP)
                        ->setRoles(['ROLE_admin-Principal']); 
                }
                else if($j==2 || $j==3){
                    $user->setProfil($profilAdm)
                     ->setRoles(['ROLE_admin']); 
                }
                else{
                    $user->setProfil($profilUtil)
                     ->setRoles(['ROLE_utilisateur']); 
                }
                
                $manager->persist($user);
            }
            $manager->flush();
        }
        //Pour les testes fonctionnels
        $UserSimpl=new Utilisateur();
        $UserSimpl->setUsername('utilisateur1')
             ->setRoles(['ROLE_Utilisateur'])
             ->setPassword($motDePass)
             ->setConfirmPassword($motDePass)
             ->setEntreprise($wari)
             ->setNom('utilisateur1')
             ->setEmail('utilisateur1@gmail.com')
             ->setTelephone(rand(770000000,779999999))
             ->setNci(strval(rand(150000000,979999999)))
             ->setStatus($actif)
             ->setProfil($profilUtil); 
        $manager->persist($UserSimpl);

        $UserCaissier=new Utilisateur();
        $UserCaissier->setUsername('caissier1')
             ->setRoles(['ROLE_Caissier'])
             ->setPassword($motDePass)
             ->setConfirmPassword($motDePass)
             ->setEntreprise($wari)
             ->setNom('caissier1')
             ->setEmail('caissier1@gmail.com')
             ->setTelephone(rand(770000000,779999999))
             ->setNci(strval(rand(150000000,979999999)))
             ->setStatus($actif)
             ->setProfil($profilCaiss); 
        $manager->persist($UserCaissier);

        $UseradminPinci=new Utilisateur();
        $UseradminPinci->setUsername('admPrincipale1')
             ->setRoles(['ROLE_admin-Principal'])
             ->setPassword($motDePass)
             ->setConfirmPassword($motDePass)
             ->setEntreprise($wari)
             ->setNom('admPrincipale1')
             ->setEmail('admPrincipale1@gmail.com')
             ->setTelephone(rand(770000000,779999999))
             ->setNci(strval(rand(150000000,979999999)))
             ->setStatus($actif)
             ->setProfil($profilAdP); 
        $manager->persist($UseradminPinci);
        $manager->flush();
    }
}
