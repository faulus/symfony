<?php

namespace ProjetBlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ProjetBlogBundle:Default:index.html.twig', array('name' => $name));
    }
}
