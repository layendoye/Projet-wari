<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Security\Core\User\UserInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/api",name="_api")
 */
class SecurityController extends AbstractFOSRestController
{
    //aller dans config -> packages -> packages  -> Security.yaml
    /**
     * @Route("/inscription", name="inscription", methods={"POST"})
     */
    public function inscriptionUtilisateur(Request $request,ObjectManager $manager,UserPasswordEncoderInterface $encoder, UserInterface $Userconnecte){
        /*
          Début variable utilisé frequement 
        */
        $libSupAdmi='Super-admin';
        $libCaissier='Caissier';
        $libAdmiPrinc='admin-Principal';
        $libAdmi='admin';
        $utilisateur='utilisateur';
        /*
          Fin variable utilisé frequement 
        */
        
        $user=new Utilisateur();
        $form=$this->createForm(UtilisateurType::class,$user);
        
        $data=json_decode($request->getContent(),true);//Récupère une chaîne encodée JSON et la convertit en une variable PHP
        $form->submit($data);
        
        if($form->isSubmitted() && $form->isValid()){
            $hash=$encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $libelle=$user->getProfil()->getLibelle();

            $profilUserConnecte=$Userconnecte->getProfil()->getLibelle();

            if($libelle == $libSupAdmi   && $profilUserConnecte != $libSupAdmi   ||
               $libelle == $libCaissier  && $profilUserConnecte != $libSupAdmi   ||
               $libelle == $libAdmiPrinc && $profilUserConnecte != $libSupAdmi   ||
               $libelle == $libAdmi      && $profilUserConnecte != $libAdmiPrinc ||
               $libelle == $utilisateur  && $profilUserConnecte != $libAdmiPrinc
            ){
                return $this->handleView($this->view(['impossible' => 'Votre profil ne vous permet pas de créer ce type d\'utilisateur'],Response::HTTP_CONFLICT));
            }
            else{
                $user->setRoles(['ROLE_'.$libelle]);
                if($libelle!=$libAdmiPrinc){//car si c'est l'admin principal on devra recuperer l'id de l'entreprise qui est sur le formulaire
                    $user->setEntreprise($Userconnecte->getEntreprise());//si ajout caissier il sera dans la même entreprise que le super-admin, si admin ou utilisateur il sera dans la même entreprise que l'admin-principal qui les a créé
                }
            }
            $user->setStatus('Actif');
            $manager->persist($user);
            $manager->flush();
            return $this->handleView($this->view(['status'=>'ok'],Response::HTTP_CREATED));
        }
        return $this->handleView($this->view($form->getErrors()));
    }

    /**
     *@Route("/connexion", name="api_login", methods={"POST"})
     */
    public function login(){ /*gerer dans config packages security.yaml*/}
}
    /*
        1 - Aller dans config -> packages -> fos_rest.yaml
        2 - Modifier le extend de cette classe par FOSRestController
        3 - Aller dans le UserType ajouter 'csrf_protection'=>false

        Pour authentification
        1 - Aller dans le fichier security.yaml
        2 - installer le bundle : composer require lexik/jwt-authentication-bundle
        3 - Lancer : mkdir -p config/jwt
        4 - Puis : openssl genrsa -out config/jwt/private.pem -aes256 4096
        5 - Un mot de passe et on confirme
        6 - Ensuite : openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
        
    */