<?php

namespace AppBundle\Service;

use Doctrine\Bundle\DoctrineBundle\Registry;

class CategoryService
{
    /**
     * @var Registry
     */
    private $registry;

    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
    }

    public function getAllCategories()
    {
        $repository = $this->registry->getRepository('AppBundle\Entity\Category');
        return $repository->findAll();
    }
}
