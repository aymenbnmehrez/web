<?php

namespace fixitBundle\Controller;
use AppBundle\Entity\Ad;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\User;

class StatController extends Controller
{
    public function StatAction(){
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Browser market shares at a specific website in 2010');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $data = array(
            array('Firefox', 45.0),
            array('IE', 26.8),
            array('Chrome', 12.8),
            array('Safari', 8.5),
            array('Opera', 6.2),
            array('Others', 0.7),
        );
        $ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));
        return $this->render('@fixit/Stat/Stat.html.twig', array(
            'chart' => $ob
        ));
    }
}
