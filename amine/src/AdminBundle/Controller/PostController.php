<?php

namespace AdminBundle\Controller;
use UserBundle\Entity\User;
use AppBundle\Entity\Post;
use AppBundle\Form\PostType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;





class PostController extends Controller
{
    public function listAction()
    {
       // $post = $this->getDoctrine()->getRepository(Post::class)->findAll();

        $em = $this->getDoctrine()->getManager()->getRepository(Post::class);

        $post = $em->findname();
       // $idUser=$this->get('security.token_storage')->getToken()->getUser();

        return $this->render('@Admin/Default/forumadmin.html.twig', array('P' => $post));

    }
//
//
//    public function CreateAction(Request $request)
//    {
//        $Form = new Post();
//        $form = $this->createForm(PostType::class, $Form);
//        $form = $form->handleRequest($request);
//        if ($form->isValid()) {
//            $Form->setUser($this->get('security.token_storage')->getToken()->getUser());
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($Form);
//            $em->flush();
//            return $this->redirectToRoute('client_forum');
//        }
//        return $this->render('@Client/Default/createPost.html.twig', array('f' => $form->createView()));
//    }
//
//    public function editPostAction($id, Request $request)
//    {
//
//        $em = $this->getDoctrine()->getManager();
//        $club = $em->getRepository(Post::class)->find($id);
//        $form = $this->createForm(PostType::class, $club);
//        $form = $form->handleRequest($request);
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($club);
//            $em->flush();
//            return $this->redirectToRoute('client_forum');
//        }
//        return $this->render('@Client/Default/createPost.html.twig', array('f' => $form->createView()));
//    }
//
//
////
   public function deletePostAction($id)
   {


       $em = $this->getDoctrine()->getManager();
       $post = $this->getDoctrine()->getRepository(Post::class)->find($id);
       $em->remove($post);
        $em->flush();
       return $this->redirectToRoute('admin_forum');
   }
}