<?php

namespace rdn\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('rdnSiteBundle:Default:index.html.twig');
    }
}
