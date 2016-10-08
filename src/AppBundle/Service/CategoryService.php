<?php

namespace AppBundle\Service;

use Doctrine\Bundle\DoctrineBundle\Registry;

class CategoryService extends BaseService
{
    public function getAllCategories()
    {
        $repository = $this->registry->getRepository('AppBundle\Entity\Category');
        return $repository->findAll();
    }
}
