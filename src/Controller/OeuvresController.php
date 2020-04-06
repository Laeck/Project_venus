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
    
    /**
     * @Route("/oeuvres/{id}", name="oeuvre_show")
     */
    public function oeuvreShow($id)
    {
        $em = $this->getDoctrine();
        
        $oeuvre = $em->getRepository(Oeuvres::class)->find($id);

        if (!$oeuvre) {
            throw $this->createNotFoundException(
                'L\oeuvre séléctionnée n\'a pas été trouvée pas l\id : '.$id
            );
        }

        return $this->render('oeuvres/show.html.twig', ['oeuvre' => $oeuvre]);
    }


    /**
     * @Route("/oeuvres/edit/{id}")
     */
    public function updateUser($id)
    {
        // ETAPE 1: Récuperer l'entitymanager et récuperer l'objet sur lequel on veut travailler

        $entityManager = $this->getDoctrine()->getManager();
        $oeuvre = $entityManager->getRepository(Oeuvres::class)->find($id);

        // ETAPE 2 : Verification si l'ID appartient bien a un Oeuvre
        if (!$oeuvre) {
            throw $this->createNotFoundException(
                'Pas d\'oeuvre pour cet '.$id
            );
        }

        // ETAPE 3 : Modifier les champs que l'on souhaite et on persiste en bdd avec flush()
        $oeuvre->setNom('Orion');
        $oeuvre->setDescription('La préférée de Mika');
        $entityManager->flush();

        // ETAPE 4 : On envoie vers la vue
        return $this->redirectToRoute('oeuvre_show', [
            'id' => $oeuvre->getId()
        ]);
    }  

    /**
     * @Route("/oeuvres", name="oeuvres")
     */
    public function oeuvresAll(OeuvresRepository $repo)
    {

        $oeuvres = $repo->findAll();

        return $this->render('oeuvres/index.html.twig', [
            'controller_name' => 'OeuvresController',
            'oeuvres' => $oeuvres
        ]);
    }

    /**
     * @Route("/oeuvres/delete/{id}")
     */
    public function oeuvreDelete($id)
    {
        // ETAPE 1: Récuperer l'entitymanager et récuperer l'objet sur lequel on veut travailler
        $entityManager = $this->getDoctrine()->getManager();
        $oeuvre = $entityManager->getRepository(Oeuvres::class)->find($id);

        // ETAPE 2 : Verification si l'ID appartient bien a un USER
        if (!$oeuvre) {
            throw $this->createNotFoundException(
                'Pas d\'oeuvre pour cet id '.$id
            );
        }

        // ETAPE 3 : On supprime et on persiste en bdd avec flush()
        $entityManager->remove($oeuvre);
        $entityManager->flush();

        // ETAPE 4 : On envoie vers la vue
        return $this->render('oeuvres/deleted.html.twig',  ['oeuvre' => $oeuvre]);
    }

}
