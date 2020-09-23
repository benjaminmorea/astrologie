<?php

namespace App\Controller;

use App\Entity\Signe;
use App\Form\SigneType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SigneController extends AbstractController
{
    /**
     * @Route("/signe", name="signe")
     */
    public function index()
    {
        return $this->render('signe/index.html.twig', [
            'controller_name' => 'SigneController',
        ]);
    }

    /**
     * @Route("/signe/ajouter", name="signe_ajouter")
     */
    public function ajouter(EntityManagerInterface $entityManager, Request $request)
    {
        $signe = new Signe();
        $signeForm = $this->createForm(SigneType::class, $signe);

        $signeForm->handleRequest($request);
        if($signeForm->isSubmitted()){
            $entityManager->persist($signe);
            $entityManager->flush();
        }

        return $this->render('signe/ajouter.html.twig', [
            "signeForm" => $signeForm->createView()
        ]);
    }
}
