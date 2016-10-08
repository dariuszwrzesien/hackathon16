<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UsersController extends BaseAdminController
{
    /**
     * @Route("/admin/users", name="adminUsers")
     */
    public function indexAction()
    {
        return $this->render('admin/users/index.html.twig', [

        ]);
    }
}
