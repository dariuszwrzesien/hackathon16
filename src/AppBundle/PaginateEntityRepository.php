<?php

namespace AppBundle;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PaginateEntityRepository extends EntityRepository
{
    const MAX_PER_PAGE = 25;

    public function findAll(int $currentPage = 1)
    {
        $query = $this->createQueryBuilder('e')->getQuery();
        return $this->paginate($query, $currentPage);
    }

    private function paginate(Query $query, int $currentPage)
    {
        $paginator = new Paginator($query);

        $paginator->getQuery()
            ->setFirstResult(self::MAX_PER_PAGE * ($currentPage - 1))
            ->setMaxResults(self::MAX_PER_PAGE);

        return $paginator;
    }
}
