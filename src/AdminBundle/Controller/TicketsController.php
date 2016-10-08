<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TicketsController extends Controller
{
    /**
     * @Route("/admin/tickets", name="adminTickets")
     */
    public function indexAction()
    {
        return $this->render('admin/tickets/index.html.twig');
    }
}
