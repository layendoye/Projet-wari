<?php

namespace App\Controller;

use App\Entity\Depot;
use App\Form\DepotType;
use App\Entity\Entreprise;
use App\Repository\EntrepriseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;
/**
 * @Route("/api")
 */
class EntrepriseController extends AbstractController
{
    /**
     * @Route("/{id}", name="show_entreprise", methods={"GET"})
    */
    public function show(Entreprise $entreprise, EntrepriseRepository $entrepriseRepository, SerializerInterface $serializer)
    {
        $entreprise = $entrepriseRepository->find($entreprise->getId());
        $data = $serializer->serialize($entreprise,'json',[
            'groups' => ['show']
        ]);
        return new Response($data,200,[
            'Content-Type' => 'application/json'
        ]);
    }

    

     /**
     * @Route("/list/entreprises", name="list_entreprise", methods={"GET"})
     */
    public function index(EntrepriseRepository $entrepriseRepository, SerializerInterface $serializer)
    {
        $entreprises = $entrepriseRepository->findAll();
        $data = $serializer->serialize($entreprises, 'json',[
            'groups' => ['list']
        ]);

        return new Response($data, 200, [
            'Content-Type' => 'application/json'
        ]);
    }

    /**
     * @Route("/add/entreprises", name="add_entreprise", methods={"POST"})
     * @Route("/add/utilisateurs", name="add_utilisateur", methods={"POST"})
     */
    public function new(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {
        
        $entreprise = $serializer->deserialize($request->getContent(), Entreprise::class,'json');
        $entityManager->persist($entreprise);
        $entityManager->flush();
        $data = [
            'status' => 201,
            'message' => 'L\'entreprise a été bien enregistré'
        ];
        return new JsonResponse($data, 201);
    }

    /**
    * @Route("/entreprises/{id}", name="update_entreprise", methods={"PUT"})
    */ 
    public function update(Request $request, SerializerInterface $serializer, Entreprise $entreprise, ValidatorInterface $validator, EntityManagerInterface $entityManager)
        {
            $entrepriseUpdate = $entityManager->getRepository(Entreprise::class)->find($entreprise->getId());
            $data = json_decode($request->getContent());
            foreach ($data as $key => $value){
                if($key && !empty($value)) {
                    $name = ucfirst($key);
                    $setter = 'set'.$name;
                    $entrepriseUpdate->$setter($value);
                }
            }
            $errors = $validator->validate($entrepriseUpdate);
            if(count($errors)) {
                $errors = $serializer->serialize($errors, 'json');
                return new Response($errors, 500, [
                    'Content-Type' => 'application/json'
                ]);
            }
            $entityManager->flush();
            $data = [
                'status' => 200,
                'message' => 'L\'entreprise a bien été mis à jour'
            ];
            return new JsonResponse($data);
        }

    /**
    * @Route("/bloque/entreprises/{id}", name="bloque_entreprise", methods={"PUT"})
    */ 
    public function bloque(Request $request, SerializerInterface $serializer, Entreprise $entreprise, ValidatorInterface $validator, EntityManagerInterface $entityManager, ObjectManager $manager)
    {
        if($entreprise->getStatus() == "Actif"){
            $entreprise->setStatus("bloqué");
            $reponse= new Response('Partenaire bloqué', 200, [
                'Content-Type' => 'application/json'
            ]);
            
        }
        else{
            $entreprise->setStatus("Actif");
            $reponse= new Response('Partenaire débloqué', 200, [
                'Content-Type' => 'application/json'
            ]);
        }
        $manager->persist($entreprise);
        $manager->flush();
        return $reponse;
    }

   
    /**
     * @Route("/depot/entreprise")
     */

     public function depot (Request $request, UserInterface $Userconnecte)
     {
         $depot = new Depot();

         $form = $this->createForm(DepotType::class, $depot);
         $data=json_decode($request->getContent(),true);
         $form->submit($data);

         if($form->isSubmitted() && $form->isValid())
         {
            $depot->setDate(new \DateTime());
            $depot->setCaissier($Userconnecte);
            $entreprise=$depot->getEntreprise();
            $entreprise->setSolde($entreprise->getSolde()+$depot->getMontant());
            $manager=$this->getDoctrine()->getManager();
            $manager->persist($entreprise);
            $manager->persist($depot);
            $manager->flush();
            $data = [
                'status' => 201,
                'message' => 'Le depot a bien été effectué '
            ];
            return new JsonResponse($data, 201);

         }
         return new JsonResponse($this->view($form->getErrors()), 500);
     }
}
