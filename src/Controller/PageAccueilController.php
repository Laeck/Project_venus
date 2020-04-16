<?php

namespace App\Controller;

use App\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageAccueilController extends AbstractController
{
    /**
     * @Route("/", name="page_accueil")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Categories::class)->findAll();

        return $this->render('page_accueil/index.html.twig', array(
            'categories' => $categories
        ));
    }
}
