<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
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

        return $this->render('admin/dashboard/index.html.twig', $templateParams);
    }
}
