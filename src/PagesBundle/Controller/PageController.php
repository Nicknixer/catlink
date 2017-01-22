<?php

namespace PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PageController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function homepageAction()
    {
        $sites = $this->getDoctrine()
            ->getRepository('AppBundle:Site')
            ->findBy([
                'isModerated' => 1
            ],[
                'id' => 'ASC'
            ], 5); // Last 5 sites

        return $this->render('PagesBundle:Default:homepage.html.twig', [
            'sites' => $sites
        ]);
    }

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
