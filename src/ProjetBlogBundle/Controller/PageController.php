<?php
// src/Blogger/ProjetBlogBundle/Controller/PageController.php

namespace ProjetBlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Collections\ArrayCollection;
use ProjetBlogBundle\Entity\Enquiry;
use ProjetBlogBundle\Form\EnquiryType;
use ProjetBlogBundle\Entity\Advert;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProjetBlogBundle:Page:index.html.twig');
    }

     public function aboutAction()
    {
        return $this->render('ProjetBlogBundle:Page:about.html.twig');
    }


    public function contactAction()
{
    $enquiry = new Enquiry();
    $form = $this->createForm(new EnquiryType(), $enquiry);

    $request = $this->getRequest();
    if ($request->getMethod() == 'POST') {
        $form->bindRequest($request);

        if ($form->isValid()) {

        	$message = \Swift_Message::newInstance()
            ->setSubject('Contact enquiry from symblog')
            ->setFrom('enquiries@symblog.co.uk')
            ->setTo('email@email.com')
            ->setBody($this->renderView('ProjetBlogBundle:Page:contactEmail.txt.twig', array('enquiry' => $enquiry)));
        $this->get('mailer')->send($message);

        $this->get('session')->setFlash('blogger-notice', 'Your contact enquiry was successfully sent. Thank you!');
            // Perform some action, such as sending an email

            // Redirect - This is important to prevent users re-posting
            // the form if they refresh the page
            return $this->redirect($this->generateUrl('ProjetBlogBundle_contact'));
        }
    }

    return $this->render('ProjetBlogBundle:Page:contact.html.twig', array(
        'form' => $form->createView()
    ));
}

 public function connexionAction()
    {
        return $this->render('ProjetBlogBundle:Page:connexion.html.twig');
    }
}