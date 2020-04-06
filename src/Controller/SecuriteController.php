<?php

namespace App\Controller;


use App\Entity\Utilisateurs;
use App\Form\UtilisateursType;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SecuriteController extends AbstractController
{
    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion(Request $request): Response
    {
        $utilisateur = new Utilisateurs();

        $form = $this->createForm(UtilisateursType::class, $utilisateur);

        $form->handleRequest($request);

        if($form->isMethod('POST') && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $utilisateur = $entityManager->getRepository(UtilisateursType::class)->findAll();

            $entityManager->persist($utilisateur);
            $entityManager->flush();
        }

        return $this->render('securite/connexion.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
