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
     * @param int $newStatus
     */
    public function updateTicketStatus(int $ticketId, int $newStatus)
    {
        $ticket = $this->getTicket($ticketId);
        $ticket->setStatus($newStatus);
        $this->saveTicket($ticket);
    }

    /**
     * @param int $ticketId
     */
    public function cancelTicket(int $ticketId)
    {
        $ticket = $this->getTicket($ticketId);
        $ticket->setStatus(Ticket::CANCELED);
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
