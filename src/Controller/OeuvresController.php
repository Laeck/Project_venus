<?php

namespace App\Controller;

use App\Entity\Oeuvres;
use App\Form\OeuvresType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\OeuvresRepository ;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class OeuvresController extends AbstractController
{

    /**
     * @Route("/", name="accueil_site")
     */
    public function accueil() 
    {
        return $this->render('oeuvres/accueil.html.twig');
    }

    /**
     * @Route("/oeuvres/creation", name="oeuvres_creation")
     */
    public function formOeuvres(Request $request): Response
    {
        $oeuvre = new Oeuvres();

        $formOeuvres = $this->createForm(OeuvresType::class, $oeuvre);

        if($request->isMethod('POST'))
        {
            $formOeuvres->handleRequest($request);

            if($formOeuvres->isValid())
            {
                $entityManager = $this->getDoctrine()->getManager();
                $oeuvres = $entityManager->getRepository(Oeuvres::class)->findAll();

                $entityManager->persist($oeuvre);
                $entityManager->flush();

                return $this->redirectToRoute('oeuvres', array('oeuvres' => $oeuvres));
            }
        }

        return $this->render('oeuvres/form.html.twig', array(
            'formOeuvres' => $formOeuvres->createView(),
        ));
        
    }
    
    public function oeuvresCategorie()
    {

    }

    /**
     * @Route("/oeuvres", name="oeuvres")
     */
    public function index(OeuvresRepository $repo)
    {


        $oeuvres = $repo->findAll();

        return $this->render('oeuvres/index.html.twig', [
            'controller_name' => 'OeuvresController',
            'oeuvres' => $oeuvres
        ]);
    }

}
