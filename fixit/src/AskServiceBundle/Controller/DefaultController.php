<?php

namespace AskServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AskServiceBundle:Default:index.html.twig');
    }
}
