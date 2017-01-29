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
            'lastSite' => $this->getLastSite(),
            'categories' => $this->getAllCategory(),
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
            ->where('s.isModerated = 1')
            ->getQuery()
            ->getSingleScalarResult();
    }

    /*
     * Get last added site
     * @return Site
     */
    private function getLastSite()
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Site');

        return $repository->
            findOneBy(['isModerated' => '1'],['id' => 'DESC']);
    }

    /*
     * Get all category
     * @return Array of Category
     */
    private function getAllCategory() {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Category');

        return $repository->
        findBy(
            [],
            ['name' => 'ASC']
        );
    }
}
