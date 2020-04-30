<?php

namespace App\Controller;

use App\Entity\Artiste;
use App\Entity\Experience;
use App\Entity\Recompense;
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

        $em = $this->getDoctrine()->getManager();
        $experience = $em->getRepository(Experience::class)->findAll();

        $em = $this->getDoctrine()->getManager();
        $recompense = $em->getRepository(Recompense::class)->findAll();
    
        return $this->render('biographie/index.html.twig', array(
            'artiste' => $artiste, 'experience' => $experience, 'recompense' => $recompense
        ));
    }

}
