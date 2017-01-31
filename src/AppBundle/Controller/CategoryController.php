<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CategoryController extends Controller
{

    /**
     *
     *
     * @Route("/category/{id}", name="showCategory")
     *
     */
    public function showCategoryAction($id)
    {
        $category = $this->getDoctrine()
            ->getRepository('AppBundle:Category')
            ->find($id);

        if (!$category) {
            return $this->redirectToRoute('homepage');
        }

        return $this->render('AppBundle:Default:showcategory.html.twig', [
            'category' => $category,
            'sites' => $category->getSites()
        ]);
    }
}
