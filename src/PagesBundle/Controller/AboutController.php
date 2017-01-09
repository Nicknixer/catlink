<?php

namespace PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AboutController extends Controller
{
    /**
     * @Route("/about", name="about")
     */
    public function indexAction()
    {
        return $this->render('PagesBundle:Default:about.html.twig');
    }
}
