<?php

declare(strict_types=1);

namespace AppBundle;

class PaginatedResults
{
    /**
     * @var array
     */
    private $items = [];

    /**
     * @var int
     */
    private $totalItems;

    /**
     * @var int
     */
    private $perPage;

    /**
     * @var int
     */
    private $totalPages;

    /**
     * @var int
     */
    private $currentPage;

    /**
     * @param $total
     * @param $limit
     * @return int
     */
    private function calculateTotalPages(int $total, int $limit)
    {
        $pages = (int)ceil($total / $limit);

        return !$pages ? 1 : $pages;
    }

    /**
     * @param $page
     * @return int
     */
    private function calculateCurrentPage(int $page)
    {
        if ($page <= 0 || $page > $this->totalPages) {
            throw new \InvalidArgumentException('Invalid page number: ' . $page);
        }

        return $page;
    }

    /**
     * PaginatedResults constructor.
     * @param array $items
     * @param int $total
     * @param int $page
     * @param int $limit
     */
    public function __construct(array $items, int $total, int $page, int $limit)
    {
        $this->items = $items;
        $this->totalItems = $total;
        $this->perPage = $limit;
        $this->totalPages = $this->calculateTotalPages($total, $limit);
        $this->currentPage = $this->calculateCurrentPage($page);
    }

    /**
     * @return array
     */
    public function getItems() : array
    {
        return $this->items;
    }

    /**
     * @return int
     */
    public function getTotalItems() : int
    {
        return $this->totalItems;
    }

    /**
     * @return int
     */
    public function getItemsPerPage() : int
    {
        return $this->perPage;
    }

    /**
     * @return int
     */
    public function getCurrentPage() : int
    {
        return $this->currentPage;
    }

    /**
     * @return int
     */
    public function getTotalPages() : int
    {
        return $this->totalPages;
    }
}