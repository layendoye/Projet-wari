<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Entity\Entreprise;
use App\Repository\UtilisateurRepository;

/**
 * @Route("/api",name="_api")
 */
class SecurityController extends FOSRestController
{
    //aller dans config -> packages -> packages  -> Security.yaml
    /**
     * @Route("/inscription", name="inscription", methods={"POST"})
     * @Security("has_role('ROLE_Super-admin','ROLE_admin-Principal','ROLE_admin')")
     */
    public function inscriptionUtilisateur(Request $request,ObjectManager $manager,UserPasswordEncoderInterface $encoder, UtilisateurRepository $repo)
    {//inscription
        
        $user=new Utilisateur();
        
        $form=$this->createForm(UtilisateurType::class,$user);
        
        $data=json_decode($request->getContent(),true);//Récupère une chaîne encodée JSON et la convertit en une variable PHP
        $form->submit($data);
        
        if($form->isSubmitted() && $form->isValid()){
            $hash=$encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $profil=$user->getProfil();
            $libelle=$profil->getLibelle();

            $idEntreprise=$user->getEntreprise()->getId();
            $profil=$user->getProfil()->getId();
            //
            
            if($libelle=='Super-admin'){
                
              $user->setRoles(['ROLE_Super-admin']);  
            }
            elseif($libelle=='Caissier'){
                $user->setRoles(['ROLE_Caissier']); 
            }
            elseif($libelle=='admin-Principal'){
                $user->setRoles(['ROLE_admin-Principal']); 
            }
            elseif($libelle=='admin'){//max 2
                if(count($repo->findBy(['Entreprise' => $idEntreprise,'Profil'=>$profil]))>=2){
                    return $this->handleView($this->view(['Impossible'=>'Il y\'a déja 2 admin pour votre entreprise'],Response::HTTP_CONFLICT));
                }
                $user->setRoles(['ROLE_admin']); 
            }
            elseif($libelle=='utilisateur'){//max 5
                if(count($repo->findBy(['Entreprise' => $idEntreprise,'Profil'=>$profil]))>=5){
                    return $this->handleView($this->view(['Impossible'=>'Il y\'a déja 2 admin pour votre entreprise'],Response::HTTP_CONFLICT));
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