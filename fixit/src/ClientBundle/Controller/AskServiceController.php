<?php

namespace ClientBundle\Controller;
use AppBundle\Entity\AskService;
use AppBundle\Entity\Category;
use AppBundle\Entity\Job;
use AppBundle\Form\AskServiceType;
use Stripe\Exception\ApiErrorException;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class AskServiceController extends Controller
{
    public function indexAction( )
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
            $askService->setUser($this->get('security.token_storage')->getToken()->getUser()); //
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
    public function deleteAskServiceAction($id){
        $em = $this->getDoctrine()->getManager();
        $askService=$em->getRepository(AskService::class)->find($id);
        $jb = $this->getDoctrine()->getManager();
        $job=$jb->getRepository(Job::class)->findOneBy(['askService'=>$id]);
        if(!$job==null){
            $em->remove($job);
            $em->flush();
        }
        $em->remove($askService);
        $em->flush();
        return $this->redirectToRoute('client_displayservice');
    }
    public function editAskServiceAction($id,Request $request){
        $em = $this->getDoctrine()->getManager();
        $askService=$em->getRepository(AskService::class)->find($id);
        $form=$this->createForm(AskServiceType::class,$askService);
        $form = $form->handleRequest($request);
        if ($form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($askService);
            $em->flush();
            return $this->redirectToRoute('client_displayservice');
        }
        return $this->render('@Client/Default/addAskService.html.twig',array('f' =>$form->createView()));
}
    public function showpaiementAction(Request $request){
        \Stripe\Stripe::setApiKey('sk_test_4AjwOwObKwTFCEPqhgTNyKJ7003iYaG9PT');

// `source` is obtained with Stripe.js; see https://stripe.com/docs/payments/accept-a-payment-charges#web-create-token
        try {
            \Stripe\Charge::create([
                'amount' => 2000,
                'currency' => 'usd',
                'source' => $request->request->get('stripeToken'),
                'description' => "Paiement de test"
            ]);
        } catch (ApiErrorException $e) {
        }

        return $this->render('@Client/Default/paiement.html.twig');

    }

    public function paiementAction(Request $request){
//        \Stripe\Stripe::setApiKey('sk_test_4AjwOwObKwTFCEPqhgTNyKJ7003iYaG9PT');
//
//// `source` is obtained with Stripe.js; see https://stripe.com/docs/payments/accept-a-payment-charges#web-create-token
//        try {
//            \Stripe\Charge::create([
//                'amount' => 2000,
//                'currency' => 'usd',
//                'source' => $request->request->get('stripeToken'),
//                'description' => "Paiement de test"
//            ]);
//        } catch (ApiErrorException $e) {
//        }
        return $this->redirectToRoute('client_displayservice');
    }


    public function OurCategoryAction()
    {
//        return $this->render('@Service/AddCategory.html.twig');
        $Category = $this->getDoctrine()->getRepository(Category::class)->findAll();
        return $this->render('@Client/Default/OurCategory.html.twig', array('Category' => $Category));
    }
}
