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
        $content = $this->renderView('rdnSiteBundle:Home:recette.html.twig',array('nom' => $id));

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
