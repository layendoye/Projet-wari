<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Depot;

class TransactionController extends AbstractController
{
    /**
     * @Route("/transaction", name="transaction")
     */
    public function index()
    {
        return $this->render('transaction/index.html.twig', [
            'controller_name' => 'TransactionController',
        ]);
    }

    public function depot (Request $request)
    {
        $depot = new Depot();

        $form = $this->createForm(Depottype::class,$depot);
        $data=json_decode($request->getContent(),true);
        $form->submit($data);

        if($form->isSubmitted())
        {
            $dep=$this->getDoctrine()->getManager();
            $dep->persist($depot);
            $dep->flush();
            return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_CREATED));

        }

        return $this->handleView($this->view($form->getErrors));

        
    }
}


