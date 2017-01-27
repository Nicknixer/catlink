<?php

namespace PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
    public function feedbackAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('name', TextType::class)
            ->add('email', EmailType::class)
            ->add('message', TextareaType::class)
            ->add('send', SubmitType::class, [
                'label' => 'Отправить'
            ])
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted()  && $form->isValid()) {
            return $this->render('PagesBundle:Default:feedback_success.html.twig', [
                'name' => $form->get('name')->getData()
            ]);
        }
        return $this->render('PagesBundle:Default:feedback.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
