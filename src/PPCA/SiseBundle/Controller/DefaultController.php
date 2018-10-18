<?php

namespace PPCA\SiseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SiseBundle:Default:index.html.twig');
    }
}
