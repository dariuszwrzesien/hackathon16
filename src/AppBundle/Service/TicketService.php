<?php

namespace AppBundle\Service;

use AppBundle\Entity\Ticket;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Registry;

class TicketService
{
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
    public function getAllTickets()
    {
        $repository = $this->registry->getRepository('AppBundle\Entity\Ticket');
        return $repository->findBy([], ['created' => 'DESC']);
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
