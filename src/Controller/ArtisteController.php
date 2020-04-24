<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArtisteController extends AbstractController
{
    /**
     * @Route("/biographie", name="biographie")
     */
    public function index()
    {
        return $this->render('biographie/index.html.twig', [
            'controller_name' => 'ArtisteController',
        ]);
    }
}
