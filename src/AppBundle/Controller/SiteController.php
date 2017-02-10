<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Site;

class SiteController extends Controller
{

    /**
     *
     * @Route("/site{trailingSlash}", requirements={"trailingSlash" = "[/]{0,1}"})
     * @Route("/site/{id}", name="showSite")
     *
     */
    public function showSiteAction($id = -1)
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



        return $this->render('AppBundle:Site:showsite.html.twig', [
            'site' => $site,
            'category' => $site->getCategory(),
            'comments' => $site->getComments(),
        ]);
    }

    /**
     *
     * @Route("/add", name="addSite")
     *
     */
    public function addSite(Request $request)
    {
        $site = new Site();
        $site->setTitle("Название");
        $form = $this->createFormBuilder($site)
            ->add('title', TextType::class)
            ->add('url', UrlType::class)
            ->add('email', EmailType::class)
            ->add('category', ChoiceType::class, [
                'choices' => $this->getDoctrine()->getRepository('AppBundle:Category')->findAll(),
                'choice_label' => function($category, $key, $index) {
                    return $category->getName();
                }
            ])
            ->add('shortDescription', TextareaType::class)
            ->add('description', TextareaType::class)
            ->add('keywords', TextType::class)
            ->add('add', SubmitType::class, array('label' => 'Добавить'))
            ->getForm();


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $site = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($site);
            $em->flush();

            return $this->render('AppBundle:Site:successAddingSite.html.twig', array(
                'site' => $site,
            ));
        }

        return $this->render('AppBundle:Site:addSite.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     *
     *
     */
    public function commentFormAction(Request $request, Site $site)
    {
        $comment = new Comment();
        $comment->setSite($site);
        $form = $this->createFormBuilder($comment)
            ->add('name', TextType::class)
            ->add('message', TextareaType::class)
            ->add('add', SubmitType::class, array('label' => 'Добавить комментарий'))
            ->getForm();
        return $this->render('AppBundle:Site:commentform.html.twig', array(
            'site' => $site,
            'form' => $form->createView(),
        ));
    }

    /**
     *
     * @Route("/site/{id}/add", name="addComment")
     *
     */
    public function addCommentAction(Request $request, Site $site)
    {
        $comment = new Comment();
        $comment->setSite($site);
        $form = $this->createFormBuilder($comment)
            ->add('name', TextType::class)
            ->add('message', TextareaType::class)
            ->add('add', SubmitType::class, array('label' => 'Добавить комментарий'))
            ->getForm();


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            return $this->redirectToRoute('showSite', ['id' => $site->getId()]);
        }
    }
}
