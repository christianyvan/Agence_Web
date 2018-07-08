<?php

namespace OC\WebAgencyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OCWebAgencyBundle:Default:index.html.twig');
    }
}
