<?php

namespace App\Controller;

use App\Entity\Artiste;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BiographieController extends AbstractController
{
    /**
     * @Route("/biographie", name="biographie")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $artiste = $em->getRepository(Artiste::class)->findAll();
    
        return $this->render('biographie/index.html.twig', array(
            'artiste' => $artiste
        ));
    }
}
