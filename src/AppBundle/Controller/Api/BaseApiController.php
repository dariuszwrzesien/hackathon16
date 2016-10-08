<?php

namespace AppBundle\Controller\Api;

use AppBundle\Controller\ServicesTrait;
use FOS\RestBundle\Controller\FOSRestController;

class BaseApiController extends FOSRestController
{
    use ServicesTrait;
}
