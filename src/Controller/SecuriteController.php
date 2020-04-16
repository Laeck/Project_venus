<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecuriteController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('securite/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    //     /**
    //  * @Route("/login", name="login")
    //  */
    // public function login(Request $request): Response
    // {
    //     $utilisateur = new Utilisateurs();

    //     $form = $this->createForm(UtilisateursType::class, $utilisateur);

    //     $form->handleRequest($request);

    //     if($form->isSubmitted() && $form->isValid())
    //     {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $utilisateur = $entityManager->getRepository(UtilisateursType::class)->findAll();

    //         $entityManager->persist($utilisateur);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('login');
    //     }

    //     return $this->render('securite/login.html.twig', [
    //         'form' => $form->createView()
    //     ]);
    // }

    // /**
    // *@Route("/login", name="login")
    // */
    // public function login() 
    // {
    //     return $this->render('securite/login.html.twig');
    // }

    /**
    *@Route("/deconnexion", name="deconnexion")
    */
    // public function deconnexion() 
    // {
    //     return $this->render('securite/login.html.twig');
    // }
}
