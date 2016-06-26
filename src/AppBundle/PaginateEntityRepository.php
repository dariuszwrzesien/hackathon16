<?php

namespace AppBundle;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PaginateEntityRepository extends EntityRepository
{
    private $query;
    private $currentPage;
    private $recordsCount;

    public function findAll(int $currentPage = 1, int $recordsCount = 25)
    {
        $this->currentPage = $currentPage;
        $this->recordsCount = $recordsCount;
        $this->query = $this->createQueryBuilder('alias')->getQuery();
        return $this->paginate();
    }

    private function paginate()
    {
        $paginator = new Paginator($this->query);

        $paginator->getQuery()
            ->setFirstResult($this->recordsCount * ($this->currentPage - 1))
            ->setMaxResults($this->recordsCount);

        return $paginator;
    }
}
