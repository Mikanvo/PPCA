<?php

namespace PPCA\ArchivageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ArchivageBundle:Default:index.html.twig');
    }
}
