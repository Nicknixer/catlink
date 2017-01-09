<?php

namespace PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RulesController extends Controller
{
    /**
     * @Route("/rules", name="rules")
     */
    public function indexAction()
    {
        return $this->render('PagesBundle:Default:rules.html.twig');
    }
}
