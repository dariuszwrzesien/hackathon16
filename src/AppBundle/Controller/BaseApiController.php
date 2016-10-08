<?php

namespace AppBundle\Controller;

use AppBundle\Service\CategoryService;
use FOS\RestBundle\Controller\FOSRestController;

class BaseApiController extends FOSRestController
{
    /**
     * @return CategoryService
     */
    public function getCategoryService() : CategoryService
    {
        return $this->get('category.service');
    }
}
