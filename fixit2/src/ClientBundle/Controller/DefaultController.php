<?php

namespace ClientBundle\Controller;

use AppBundle\Entity\AskService;
use AppBundle\Entity\Category;
use AppBundle\Entity\Service;
use AppBundle\Form\AskServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
class DefaultController extends Controller
{
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $category = $repository->findAll();
        return $this->render('@Client/Default/index.html.twig', array('as' => $category));
    }
    public function afficheDetailAction($id)
    {
        $cat=$this->getDoctrine()->getRepository(Category::class)->findOneBy(['category_id'=>$id]);

        $Service=$this->getDoctrine()->getRepository(Service::class)->findBy(['category'=>$cat]);

        return $this->render('@Client/Default/Detail.html.twig', array('Service' => $Service));

    }


  /*  public function displayCategoryAction()
    {
        //$user = $this->get('security.token_storage')->getToken()->getUser();
        //   $id=$user->getId();
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $category = $repository->findAll();
        return $this->render('@Client/Default/index.html.twig', array('as' => $category));
    }*/

}
