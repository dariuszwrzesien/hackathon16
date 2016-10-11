<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Comment;
use AppBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class CommentsController extends BaseAdminController
{
    /**
     * @Route("/admin/comments/{id}", requirements={"id" = "\d+"}, name="adminComments")
     *
     * @return Response
     */
    public function indexAction(Request $request, $id)
    {
        $ticket = $this->getDoctrine()->getRepository('AppBundle\Entity\Ticket')->find($id);

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setDescription($form->getData()->description);
            $comment->setCreated(new \DateTime());
            $comment->setTicket($ticket);

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
        }

        return $this->render('admin/comments/index.html.twig', [
            'ticket' => $ticket,
            'comments' => $this->getCommentService()->getCommentsByTicketId($id),
            'form' => $this->createForm(CommentType::class, new Comment())->createView()
        ]);
    }
}
