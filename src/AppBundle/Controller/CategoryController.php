<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class CategoryController extends Controller
{

    /**
     * @Route("/category{trailingSlash}", requirements={"trailingSlash" = "[/]{0,1}"})
     * @Route("/category/{id}", requirements={"id" = "\d+"}, name="showCategory")
     *
     */
    public function showCategoryAction($id = -1)
    {
        $category = $this->getDoctrine()
            ->getRepository('AppBundle:Category')
            ->find($id);

        if (!$category) {
            return $this->redirectToRoute('homepage');
        }

        $sites = $category->getSites()->filter(function ($site) {
            return $site->getIsModerated() == 1;
        }); // Get moderated sites

        return $this->render('AppBundle:Category:showcategory.html.twig', [
            'category' => $category,
            'sites' => $sites

        ]);
    }
}
