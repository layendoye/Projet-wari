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
        $impossible='Impossible';
        $TextBloquerProfil='Votre profil ne vous permet pas de créer ce type d\'utilisateur';
        $libSupAdmi='Super-admin';
        $libCaissier='Caissier';
        $libAdmiPrinc='admin-Principal';
        $libAdmi='admin';
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
            if($libelle==$libSupAdmi){//ajout super-admin
                if($profilUserConnecte!=$libSupAdmi){//si le profil est different de Super-admin
                    return $this->handleView($this->view([$impossible => $TextBloquerProfil],Response::HTTP_CONFLICT));
                }
                $user->setRoles(['ROLE_Super-admin']);  
            }
            elseif($libelle==$libCaissier){//ajout caissier
                if($profilUserConnecte!=$libSupAdmi){
                    return $this->handleView($this->view([$impossible => $TextBloquerProfil],Response::HTTP_CONFLICT));
                }
                $user->setRoles(['ROLE_Caissier']); 
            }
            elseif($libelle==$libAdmiPrinc){//ajout admin-principal
                if($profilUserConnecte!=$libSupAdmi){
                    return $this->handleView($this->view([$impossible => $TextBloquerProfil],Response::HTTP_CONFLICT));
                }
                $user->setRoles(['ROLE_admin-Principal']); 
            }
            elseif($libelle==$libAdmi){
                if($profilUserConnecte!=$libAdmiPrinc){//si le profil est different de admin-principal
                    return $this->handleView($this->view([$impossible => $TextBloquerProfil],Response::HTTP_CONFLICT));
                }
                $user->setRoles(['ROLE_admin']); 
            }
            elseif($libelle=='utilisateur'){
                if($profilUserConnecte!=$libAdmiPrinc){//si le profil est different de admin-principal
                    return $this->handleView($this->view([$impossible => $TextBloquerProfil],Response::HTTP_CONFLICT));
                }
                $user->setRoles(['ROLE_utilisateur']);
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