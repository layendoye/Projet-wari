<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Repository\EntrepriseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
     * @Route("/{page<\d+>?1}", name="list_entreprise", methods={"GET"})
     */
    public function index(Request $request, EntrepriseRepository $entrepriseRepository, SerializerInterface $serializer)
    {
        $page = $request->query->get('page');
        if(is_null($page) || $page < 1) {
            $page = 1;
        }
        
        $entreprises = $entrepriseRepository->findAllEntreprises($page,getenv('LIMIT'));
        $data = $serializer->serialize($entreprises,'json',[
            'groups' => ['list']
        ]);
    
        return new Response($data, 200, [
            'Content-Type' => 'application/json'
        ]);
    }

    /**
     * @Route("/add/entreprises", name="add_entreprise", methods={"POST"})
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
    
}
