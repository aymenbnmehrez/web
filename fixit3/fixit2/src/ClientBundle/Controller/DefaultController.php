<?php

namespace ClientBundle\Controller;

use AppBundle\Entity\Ad;
use AppBundle\Entity\AdFav;
use AppBundle\Bundle\Repository\AdFavRepository;
use AppBundle\Form\AdType;
use AppBundle\Form\AdFavType;
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

    public function showAllAdAction(Request $request)
    {
        //fetching Objects (ad) from the DataBase
        $ad=$this->getDoctrine()->getRepository(Ad::class)->findAll();

        $ad  = $this->get('knp_paginator')->paginate(
            $ad,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
            6/*nbre d'éléments par page*/
        );
        return $this->render('@Client/Default/showAllAds.html.twig',array('ads'=>$ad));
    }

    public function showMoreDetailsAction($ad_id)
    {
        //fetching Objects (ad) from the DataBase
        $ad=$this->getDoctrine()->getRepository(Ad::class)->findOneBy(array('ad_id' => $ad_id));
        return $this->render('@Client/Default/showMoreDetails.html.twig',array('ad'=>$ad));
    }

    //----------Favorites--------//

    public function AddFavAction(Request $request,$id)
    {
        $adFav = new AdFav();
        $this->createForm(AdFavType::class, $adFav);
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $adFav1 = $em->getRepository('AppBundle:AdFav')->checkFav($user, $id);
        if ($adFav1 == null) {
            $id = $request->get("id");
            $adFav->setUser($user);
            $idAd = $this->getDoctrine()->getRepository(Ad::class)->find($id);
            $adFav->setIdAd($idAd);
            $em->persist($adFav);
            $em->flush();
            return $this->redirectToRoute("client_displayad");
        }

            return $this->redirectToRoute("client_displayad");

    }

        public function showMyFavAdsAction(Request $request)
    {
        //fetching Objects (adFav) from the DataBase
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $adFav=$this->getDoctrine()->getRepository(AdFav::class)->findBy(['user' => $user]);

        $adFav  = $this->get('knp_paginator')->paginate(
            $adFav,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
            6/*nbre d'éléments par page*/
        );
        return $this->render('@Client/Default/showMyFavAds.html.twig',array('ads'=>$adFav));
    }

    public function deleteFavAdsAction($adFav_id)
    {  $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $em= $this->getDoctrine()->getManager();

      //  $adFav=$this->getDoctrine()->getRepository(AdFav::class)->findBy(['user' => $user]);
        $adFav1=$em->getRepository(AdFav::class)->find($adFav_id);
        $em->remove($adFav1);
        $em->flush();
        return $this->redirectToRoute("client_showMyFavAds");
    }

}
