<?php

namespace App\Form;

use App\Entity\Profil;
use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Entreprise;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('password')
            ->add('confirmPassword')
            ->add('Nom')
            ->add('Email')
            ->add('Telephone')
            ->add('Nci')
            ->add('Entreprise',EntityType::class,['class'=> Entreprise::class,'choice_label'=>'RaisonSociale'])
            ->add('Profil',EntityType::class,['class'=> Profil::class,'choice_label'=>'Libelle'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
            'csrf_protection'=>false
        ]);
    }
}
