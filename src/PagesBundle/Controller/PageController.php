<?php

namespace PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PageController extends Controller
{
    /**
     * @Route("/about", name="about")
     */
    public function aboutAction()
    {
        return $this->render('PagesBundle:Default:about.html.twig');
    }

    /**
     * @Route("/rules", name="rules")
     */
    public function rulesAction()
    {
        return $this->render('PagesBundle:Default:rules.html.twig');
    }

    /**
     * @Route("/feedback", name="feedback")
     */
    public function feedbackAction()
    {
        return $this->render('PagesBundle:Default:feedback.html.twig');
    }
}
