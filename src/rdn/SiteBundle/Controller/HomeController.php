<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace rdn\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
// POST GET
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function indexAction()
    {
        $content = $this->renderView('rdnSiteBundle:Home:index.html.twig',array('nom' => 'winzou'));

        return new Response($content);
    }


    public function recettesAction()
    {
        $content = $this->renderView('rdnSiteBundle:Home:recettes.html.twig',array('nom' => 'winzou'));

        return new Response($content);
    }


    public function recetteAction($id)
    {
      // On récupère le repository
        $repository = $this->getDoctrine()
          ->getManager()
          ->getRepository('rdnSiteBundle:Home')
        ;

        // On récupère l'entité correspondante à l'id $id
        $recette = $repository->find($id);
        // die("oui");

        // $recette est donc une instance de OC\PlatformBundle\Entity\Advert
        // ou null si l'id $id  n'existe pas, d'où ce if :
        if (null === $recette) {
          $content = $this->renderView('rdnSiteBundle:Home:index.html.twig',array('nom' => 'winzou'));
          return new Response($content);
        }

        // die(var_dump($recette));
        $content = $this->renderView('rdnSiteBundle:Home:recette.html.twig',array('recette' => $recette));

        return new Response($content);
    }

    public function contactAction()
    {
        $content = $this->renderView('rdnSiteBundle:Home:contact.html.twig',array('nom' => 'winzou'));

        return new Response($content);
    }

    public function loginAction()
    {
        $content = $this->renderView('rdnSiteBundle:Home:login.html.twig',array('nom' => 'winzou'));

        return new Response($content);
    }
}
