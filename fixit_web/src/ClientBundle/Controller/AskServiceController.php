<?php

namespace ClientBundle\Controller;
use AppBundle\Entity\AskService;
use AppBundle\Form\AskServiceType;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class AskServiceController extends Controller
{
    public function indexAction()
    {
       // $user = $this->get('security.token_storage')->getToken()->getUser();

       /* $User = $this->getDoctrine()->getRepository(User::class)->find();*/
        return $this->render('@ClientBundle/Default/index.html.twig' );
    }
    public function addAction(Request $request){
        $askService = new AskService();
        $form = $this->createForm(AskServiceType::class,$askService);
        $form= $form->handleRequest($request);
        if($form->isValid()){
            $askService->setUser($this->get('security.token_storage')->getToken()->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($askService);
            $em->flush();
            // return $this->redirectToRoute('client_add');
        }
        return $this->render('@Client/Default/addAskService.html.twig',array('f' =>$form->createView()));
    }
    public function displayAction()
    {
         $user = $this->get('security.token_storage')->getToken()->getUser();
     //   $id=$user->getId();
        $repository = $this->getDoctrine()->getRepository(AskService::class);
        $askService = $repository->findBy(['user' => $user]);

        return $this->render('@Client/Default/myRequest.html.twig', array('as' => $askService));
    }
}
