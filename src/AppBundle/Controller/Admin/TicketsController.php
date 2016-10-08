<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TicketsController extends BaseAdminController
{
    /**
     * @Route("/admin/tickets", name="adminTickets")
     */
    public function indexAction()
    {
        return $this->render('admin/tickets/index.html.twig');
    }
}
