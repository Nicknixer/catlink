<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class SidebarController extends Controller
{

    /**
     * Render sidebar
     */
    public function showSidebarAction()
    {
        return $this->render('AppBundle:Default:sidebar.html.twig',[
            'sitesAmount' => $this->getSiteAmount(),
        ]);
    }

    /*
     * Count all moderated sites
     * @return Integer - site amount
     */
    private function getSiteAmount()
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Site');

        return $repository->createQueryBuilder('s')
            ->select('count(s.id)')
            ->where('s.id = 1')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
