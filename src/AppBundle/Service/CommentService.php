<?php

namespace AppBundle\Service;

use AppBundle\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Registry;

class CommentService
{
    /**
     * @var Registry
     */
    private $registry;

    /**
     * @param Registry $registry
     */
    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @param int $ticketId
     * @return array
     */
    public function getCommentsByTicketId($ticketId)
    {
        $repository = $this->registry->getRepository('AppBundle\Entity\Comment');
        return $repository->findByTicket($ticketId);
    }

    /**
     * @param Comment $comment
     * @return Comment
     */
    public function saveComment(Comment $comment)
    {
        $em = $this->registry->getManager();
        $em->persist($comment);
        $em->flush();
    }
}
