<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommentsController extends Controller
{
    /**
     * @Route("/admin/comments/{id}", requirements={"id" = "\d+"}, name="adminComments")
     */
    public function indexAction($id)
    {
        return $this->render('admin/comments/index.html.twig');
    }
}
