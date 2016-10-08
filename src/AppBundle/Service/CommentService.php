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
     * @return array
     */
    public function getCommentsByTicketId($ticketId)
    {
        $repository = $this->registry->getRepository('AppBundle\Entity\Comment');
        $comments = $repository->findByTicket($ticketId);
        if (!$comments) {
            throw new EntityNotFoundException(
                'No comments found for ticket id '.$ticketId
            );
        }
        return $comments;
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
