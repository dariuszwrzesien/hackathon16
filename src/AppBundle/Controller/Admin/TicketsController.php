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
     * @Route("/admin/ticket/{ticketId}/show", name="adminShowTicket")
     */
    public function showAction($ticketId)
    {
        return $this->render('admin/tickets/show.html.twig', [
            'ticket' => $this->getTicketsService()->getTicketById($ticketId)
        ]);
    }

    /**
     * @Route("/admin/ticket/{ticketId}/start", name="adminStartProgressOnTicket")
     *
     * @param int $ticketId
     *
     * @return RedirectResponse
     */
    public function startProgressOnTicketAction(int $ticketId)
    {
        $this->getTicketsService()->startProgressOnTicket($ticketId);
        return $this->redirectToRoute('adminTickets');
    }

    /**
     * @Route("/admin/ticket/{ticketId}/close", name="adminCloseTicket")
     *
     * @param int $ticketId
     *
     * @return RedirectResponse
     */
    public function closeTicket(int $ticketId)
    {
        $this->getTicketsService()->closeTicket($ticketId);
        return $this->redirectToRoute('adminTickets');
    }

    /**
     * @Route("/admin/ticket/{ticketId}/cancel", name="adminCancelTicket")
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
