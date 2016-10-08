<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TicketsController extends BaseAdminController
{
    /**
     * @Route("/admin/tickets", name="adminTickets")
     */
    public function indexAction()
    {
        return $this->render('admin/tickets/index.html.twig', [
            'tickets' => $this->getTicketsService()->getAllTickets()
        ]);
    }

    /**
     * @Route("/admin/ticket/{ticketId}/status/{status}", name="adminUpdateTicket")
     *
     * @param int $ticketId
     * @param int $status
     *
     * @return RedirectResponse
     */
    public function updateTicketStatusAction(int $ticketId, int $status)
    {
        $this->getTicketsService()->updateTicketStatus($ticketId, $status);
        return $this->redirectToRoute('adminTickets');
    }

    /**
     * @Route("/admin/ticket/{ticketId}/close", name="adminCancelTicket")
     *
     * @param int $ticketId
     *
     * @return RedirectResponse
     */
    public function cancelTicketAction(int $ticketId)
    {
        $this->getTicketsService()->cancelTicket($ticketId);
        return $this->redirectToRoute('adminTickets');
    }
}
