<?php

namespace App\Controller;

use App\Entity\Signe;
use App\Form\SigneType;
use Cassandra\Date;
use DateTime;
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

    /**
     * @Route("signe/deviner", name="signe_deviner")
     */
    public function deviner(){
        $dateAnniversaire = new DateTime('2015-08-10');
        $signeRepo = $this->getDoctrine()->getRepository(Signe::class);
        $signes = $signeRepo->findByDateAnniv($dateAnniversaire);

        dump($signes);

        return $this->render('signe/deviner.html.twig', [
            "signes" => $signes
        ]);
    }
}
