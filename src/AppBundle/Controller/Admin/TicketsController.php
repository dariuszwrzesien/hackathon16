<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Ticket;
use AppBundle\Service\TicketService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TicketsController extends BaseAdminController
{
    /**
     * @Route("/admin/tickets/{page}", name="adminTickets")
     *
     * @param int $page
     *
     * @return Response
     */
    public function indexAction($page = 1)
    {
        $tickets = $this->getTicketsService()->getAllTickets($page);
        return $this->render('admin/tickets/index.html.twig', [
            'tickets' => $tickets,
            'limit' => TicketService::TICKET_LIMIT,
            'maxPages' => ceil(count($tickets) / TicketService::TICKET_LIMIT),
            'thisPage' => $page
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
