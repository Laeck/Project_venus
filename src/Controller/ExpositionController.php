<?php

namespace App\Controller;

use App\Repository\ExpositionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ExpositionController extends AbstractController
{
    /**
     * @Route("/exposition", name="exposition")
     */
    public function expositions(ExpositionRepository $repo)
    {
        $expositions = $repo->findAll();
        return $this->render('exposition/index.html.twig', [
            'controller_name' => 'ExpositionController',
            'exposition' => $expositions
        ]);
    }
}
