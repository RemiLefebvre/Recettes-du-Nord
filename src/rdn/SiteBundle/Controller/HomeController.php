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
      $repository = $this->getDoctrine()
        ->getManager()
        ->getRepository('rdnSiteBundle:Home')
      ;

      $recettesTop = $repository->findBy(
        array(), // Critere
        array(),        // Tri
        4,                              // Limite
        0                               // Offset
      );

      $recettesBottom = $repository->findBy(
        array(), // Critere
        array(),        // Tri
        4,                              // Limite
        4                               // Offset
      );

      // $recettes est donc une instance de OC\PlatformBundle\Entity\Advert
      // ou null si l'id $id  n'existe pas, d'où ce if :
      if (null === $recettesTop OR null === $recettesBottom ) {
        // A CHANGER >> ALLER VERS CONTOLLEUR ACCUEIL
        $content = $this->renderView('rdnSiteBundle:Home:index.html.twig',array('nom' => 'winzou'));
        return new Response($content);
      }

        $content = $this->renderView('rdnSiteBundle:Home:index.html.twig',array(
                                                                                'recettesTop' => $recettesTop,
                                                                                'recettesBottom' => $recettesBottom,
                                                                              ));

        // echo "<pre>";
        // die(var_dump($recettesTop));
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
        $recettes = $repository->find($id);
        // die("oui");

        // $recettes est donc une instance de OC\PlatformBundle\Entity\Advert
        // ou null si l'id $id  n'existe pas, d'où ce if :
        if (null === $recettes) {

          // A CHANGER >> ALLER VERS CONTOLLEUR ACCUEIL
          $content = $this->renderView('rdnSiteBundle:Home:index.html.twig',array('nom' => 'winzou'));
          return new Response($content);
        }

        // die(var_dump($recettes));
        $content = $this->renderView('rdnSiteBundle:Home:recette.html.twig',array('recette' => $recettes));

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
