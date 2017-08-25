<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Site;
use AppBundle\Form\CommentType;
use AppBundle\Form\SiteType;

class SiteController extends Controller
{

    /**
     *
     * @Route("/site{trailingSlash}", requirements={"trailingSlash" = "[/]{0,1}"})
     * @Route("/site/{id}", name="showSite")
     * @param Site $site
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function showSiteAction(Site $site)
    {
        if ($site->getIsModerated() != 1) {
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
        $form = $this->createForm(SiteType::class, $site);

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
     * Rendering comment form
     *
     */
    public function commentFormAction(Site $site)
    {
        $comment = new Comment();
        $comment->setSite($site);
        $form = $this->createForm(CommentType::class, $comment);
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
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            return $this->redirectToRoute('showSite', ['id' => $site->getId()]);
        }
        return $this->render('AppBundle:Site:commentFormError.html.twig', [
            'site' => $site,
            'form' => $form->createView(),
        ]);
    }
}
