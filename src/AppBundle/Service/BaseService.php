<?php

namespace AppBundle\Service;

use Doctrine\Bundle\DoctrineBundle\Registry;

abstract class BaseService
{
    /**
     * @var Registry
     */
    protected $registry;

    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
    }
}
