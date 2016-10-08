<?php

namespace AppBundle\Controller;

use AppBundle\Service\CategoryService;

trait ServicesTrait
{
    /**
     * @return CategoryService
     */
    public function getCategoryService() : CategoryService
    {
        return $this->get('category.service');
    }
}
