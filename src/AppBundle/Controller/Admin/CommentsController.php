<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommentsController extends BaseAdminController
{
    /**
     * @Route("/admin/comments/{id}", requirements={"id" = "\d+"}, name="adminComments")
     *
     * @param ParamFetcher $fetcher
     * @return array();
     */
    public function indexAction($id)
    {
        $comments = $this->getDoctrine()
            ->getRepository('AppBundle\Entity\Comment')
            ->findByTicket($id);

        if(null === $comments) {
            throw $this->createNotFoundException();
        }

        return $this->render('admin/comments/index.html.twig', array(
            'comments' => $comments
        ));
    }
}
