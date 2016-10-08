<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/admin/", name="admin")
     */
    public function indexAction()
    {
        $templateParams = [];
        $mockedChartData = [
            ['category' => 'Kategoria 1', 'percent' => 23],
            ['category' => 'Inna kategoria', 'percent' => 10],
            ['category' => 'Jeszcze inna', 'percent' => 45],
            ['category' => 'Pozostałe', 'percent' => 22],
        ];

        $templateParams['tickets_stats'] = $mockedChartData;

        return $this->render('admin/index.html.twig', $templateParams);
    }

    /**
     * @Route("/admin/tickets", name="admin")
     */
    public function ticketsAction()
    {
        return $this->render('admin/tickets.html.twig');
    }
}
