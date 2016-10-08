<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Comment;
use AppBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

class CommentsController extends BaseAdminController
{
    /**
     * @Route("/admin/comments/{id}", requirements={"id" = "\d+"}, name="adminComments")
     *
     * @return Response
     */
    public function indexAction(Request $request, $id)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = new Comment();
            $comment->setDescription($form->getData()->description);
            $comment->setCreated(new \DateTime());
            $comment->setTicket($this->getDoctrine()
                ->getRepository('AppBundle\Entity\Ticket')
                ->find($id));

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
        }

        $comments = $this->getCommentService()->getCommentsByTicketId($id);

        return $this->render('admin/comments/index.html.twig', array(
            'comments' => $comments,
            'form' => $form->createView()
        ));
    }
}
