<?php

namespace ClientBundle\Controller;
use AppBundle\AppBundle;
use AppBundle\Entity\AskService;
use AppBundle\Entity\Category;
use AppBundle\Entity\note;
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
    public function OurCategoryAction()
    {
//        return $this->render('@Service/AddCategory.html.twig');
        $Category = $this->getDoctrine()->getRepository(Category::class)->findAll();
        return $this->render('@Client/Default/OurCategory.html.twig', array('Category' => $Category));
    }

    public function note ()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        //   $id=$user->getId();
        $noteform = $this->createForm('AppBundle/Form/NoteType');
        if ($noteform->isSubmitted())
        {
            $note = new note() ;
            $note->setClient($user);

        }
    }
    public function RatingAction(Request $request){

        $note_service=$request->get('note_service');
        $id_service=$request->get('id_service');
        $user= $this->getUser();

        $askservice=$this->getDoctrine()->getRepository(AskService::class)->findOneBy(array('service'=>$id_service,'user'=>$user));


        //  if($askservice->getNote()==null)
        {
            $em = $this->getDoctrine()->getManager();

            $askservice->setNote($note_service);
            $this->calculmoyenne($askservice->getService());

            $em->flush();
        }
        return $this->redirectToRoute('detail_service', array('id' => 6));


    }
    public function calculmoyenne(Service $service)
    {
        $askservices=$this->getDoctrine()->getRepository(AskService::class)->findBy(array('service'=>$service));

        $somme=0;
        foreach ($askservices as $askService)
        {
            $somme+=$askService->getNote();

        }
        $moyenne=$somme/count($askservices);
        $em = $this->getDoctrine()->getManager();

        $service->setMoyenne($moyenne);
        $em->flush();
    }

}

