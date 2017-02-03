<?php

namespace AppBundle\Controller;

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

        return $this->render('AppBundle:Page:homepage.html.twig', [
            'sites' => $sites
        ]);
    }

    /**
     * @Route("/about", name="about")
     */
    public function aboutAction()
    {
        return $this->render('AppBundle:Page:about.html.twig');
    }

    /**
     * @Route("/rules", name="rules")
     */
    public function rulesAction()
    {
        return $this->render('AppBundle:Page:rules.html.twig');
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
            $user_name = $form->get('name')->getData();
            $user_email = $form->get('email')->getData();
            $user_message = $form->get('message')->getData();
            $this->sendFeedbackMessage(
                $user_name,
                $user_email,
                $user_message
            );

            return $this->render('AppBundle:Page:feedback_success.html.twig', [
                'name' => $user_name
            ]);
        }
        return $this->render('AppBundle:Page:feedback.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /*
     * Send message to admin email
     *
     * @param String $name  - User name
     * @param String $email - User email
     * @param String $message - Message from user
     */
    private function sendFeedbackMessage($name, $email, $message){
        $email_message = \Swift_Message::newInstance()
            ->setSubject('Mail from user ' . $name)
            ->setFrom($email)
            ->setTo('nicknixer@gmail.com')
            ->setBody(
                $message .
                '<br /><br />=============<br />Обратный адрес: ' .
                $email,
                'text/html'
            );
        $this->get('mailer')->send($email_message);
    }
}
