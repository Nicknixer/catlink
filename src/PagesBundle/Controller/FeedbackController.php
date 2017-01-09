<?php

namespace PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FeedbackController extends Controller
{
    /**
     * @Route("/feedback", name="feedback")
     */
    public function indexAction()
    {
        return $this->render('PagesBundle:Default:feedback.html.twig');
    }
}
