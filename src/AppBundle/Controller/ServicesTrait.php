<?php

namespace AppBundle\Controller;

use AppBundle\Service\CategoryService;
use AppBundle\Service\CommentService;

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
     * @return CommentService
     */
    public function getCommentService() : CommentService
    {
        return $this->get('comment.service');
    }
}
