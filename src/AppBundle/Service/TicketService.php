<?php

namespace AppBundle\Service;

use AppBundle\Entity\Ticket;

class TicketService extends BaseService
{
    /**
     * @return array
     */
    public function getAllTickets()
    {
        $repository = $this->registry->getRepository('AppBundle\Entity\Ticket');
        return $repository->findAll();
    }

    /**
     * @param int $id
     * @param int $newStatus
     */
    public function updateTicketStatus(int $id, int $newStatus)
    {
        $ticket = $this->getTicket($id);
        $ticket->setStatus($newStatus);
        $this->saveTicket($ticket);
    }

    /**
     * @param int $id
     *
     * @return Ticket
     */
    private function getTicket(int $id): Ticket
    {
        $repository = $this->registry->getRepository('AppBundle\Entity\Ticket');
        $ticket = $repository->findOneById($id);
        if (!$ticket) {
            throw $this->createNotFoundException(
                'No ticket found for id '.$id
            );
        }

        return $ticket;
    }

    /**
     * @param $ticket
     *
     * @return void
     */
    private function saveTicket($ticket)
    {
        $em = $this->registry->getManager();
        $em->persist($ticket);
        $em->flush();
    }
}
