<?php

namespace ClientBundle\Controller;

use AppBundle\Entity\AskService;
use AppBundle\Form\AskServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Client/Default/index.html.twig');
    }

}
