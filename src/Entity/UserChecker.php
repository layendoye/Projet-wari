<?php
namespace App\Entity;

use Exception;
use App\Entity\Utilisateur as Utilisateur ;
use Symfony\Component\Security\Core\User\UserInterface ;
use Symfony\Component\Security\Core\User\UserCheckerInterface ;


class UserChecker implements UserCheckerInterface
{//gerer dans security.yaml avec user_checker et dans services.yaml 
    public function checkPreAuth ( UserInterface $user )
    {
        if ( ! $user instanceof Utilisateur ) {//si l'utilisateur n'existe pas ne rien retourner
            return ;
        }

        if ( $user->getStatus()!='Actif') {//si l'utilisateur est bloqué
            throw new Exception('Ce compte est bloqué, veuillez contacter l\'administrateur');
        }

        if ( $user->getEntreprise()->getStatus()!='Actif') {//si l'entreprise de l'utilisateur est bloqué
            throw new Exception('Ce partenaire est bloqué, veuillez contacter l\'administrateur');
        }
    }

    public function checkPostAuth ( UserInterface $user )
    {
        if ( ! $user instanceof Utilisateur ) {
            return ;
        }
        //code à verifier apres l'authenfication
    }
}
