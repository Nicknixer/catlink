<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class SiteController extends Controller
{

    /**
     *
     *
     * @Route("/site/{id}", name="showSite")
     *
     */
    public function showSiteAction($id)
    {
        $site = $this->getDoctrine()
            ->getRepository('AppBundle:Site')
            ->findOneBy([
                'id' => $id,
                'isModerated' => 1
            ]);

        if (!$site) {
            return $this->redirectToRoute('homepage');
        }

        return $this->render('AppBundle:Default:showsite.html.twig', [
            'site' => $site,
            'category' => $site->getCategory()
        ]);
    }
}
