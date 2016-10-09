<?php

namespace AppBundle\Service;

use AppBundle\Entity\Ticket;
use AppBundle\PaginatedResults;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Registry;

class TicketService
{
    /**
     * @var Registry
     */
    protected $doctrine;

    /**
     * @param Registry $doctrine
     */
    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @param int $page
     * @param int $limit
     * @return PaginatedResults
     */
    public function getAllPaginatedTickets(int $page = 1, int $limit = 25) : PaginatedResults
    {
        $repository = $this->doctrine->getRepository(Ticket::class);

        $items = $repository->findBy([], ['created' => 'DESC'], $limit, $limit * ($page - 1));
        $total = $repository->createQueryBuilder('ticket')
            ->select('COUNT(ticket)')
            ->getQuery()
            ->getSingleScalarResult();

        return new PaginatedResults($items, $total, $page, $limit);
    }

    /**
     * @param int $id
     *
     * @return Ticket
     */
    public function getTicketById(int $id): Ticket
    {
        return $this->getTicket($id);
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
        $repository = $this->doctrine->getRepository(Ticket::class);
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
        $em = $this->doctrine->getManager();
        $em->persist($ticket);
        $em->flush();
    }
}