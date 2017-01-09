<?php

namespace PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/sad/asd/asd")
     */
    public function indexAction()
    {
        return $this->render('PagesBundle:Default:index.html.twig');
    }
}
