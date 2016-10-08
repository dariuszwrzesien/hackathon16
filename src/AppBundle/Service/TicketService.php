<?php

namespace AppBundle\Service;

use AppBundle\Entity\Ticket;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Registry;

class TicketService
{
    const TICKET_LIMIT = 25;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @param Registry $registry
     */
    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @return array
     */
    public function getAllTickets($pageNumber)
    {
        $repository = $this->registry->getRepository('AppBundle\Entity\Ticket');
        $offset = self::TICKET_LIMIT * ($pageNumber - 1);
        return $repository->findBy([], ['created' => 'DESC'], self::TICKET_LIMIT, $offset);
    }

    /**
     * @param int $ticketId
     */
    public function startProgressOnTicket(int $ticketId)
    {
        $this->updateTicketStatus($ticketId, Ticket::IN_PROGRESS);
    }

    /**
     * @param int $ticketId
     */
    public function cancelTicket(int $ticketId)
    {
        $this->updateTicketStatus($ticketId, Ticket::CANCELED);
    }

    /**
     * @param int $ticketId
     */
    public function closeTicket(int $ticketId)
    {
        $this->updateTicketStatus($ticketId, Ticket::CLOSED);
    }

    /**
     * @param int $ticketId
     * @param int $newStatus
     */
    private function updateTicketStatus(int $ticketId, int $newStatus)
    {
        $ticket = $this->getTicket($ticketId);
        $ticket->setStatus($newStatus);
        $this->saveTicket($ticket);
    }

    /**
     * @param int $id
     *
     * @return Ticket
     * @throws EntityNotFoundException
     */
    private function getTicket(int $id): Ticket
    {
        $repository = $this->registry->getRepository('AppBundle\Entity\Ticket');
        $ticket = $repository->findOneById($id);
        if (!$ticket) {
            throw new EntityNotFoundException(
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
