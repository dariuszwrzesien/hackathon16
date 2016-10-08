<?php

namespace AppBundle\Controller;

use AppBundle\Service\CategoryService;
use AppBundle\Service\TicketService;

trait ServicesTrait
{
    /**
     * @return CategoryService
     */
    public function getCategoryService() : CategoryService
    {
        return $this->get('category.service');
    }

    /**
     * @return TicketService
     */
    public function getTicketsService() : TicketService
    {
        return $this->get('ticket.service');
    }
}
