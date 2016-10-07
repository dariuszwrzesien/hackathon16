<?php

namespace AppBundle;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PaginateEntityRepository extends EntityRepository
{
    /**
     * @var
     */
    private $query;

    /**
     * @var
     */
    private $currentPage;

    /**
     * @var
     */
    private $recordsCount;

    /**
     * @param int $currentPage
     * @param int $recordsCount
     * @return Paginator
     */
    public function findAll(int $currentPage = 1, int $recordsCount = 25)
    {
        $this->currentPage = $currentPage;
        $this->recordsCount = $recordsCount;
        $this->query = $this->createQueryBuilder('alias')->getQuery();
        return $this->paginate();
    }

    /**
     * @return Paginator
     */
    private function paginate()
    {
        $paginator = new Paginator($this->query);

        $paginator->getQuery()
            ->setFirstResult($this->recordsCount * ($this->currentPage - 1))
            ->setMaxResults($this->recordsCount);

        return $paginator;
    }
}
