<?php

namespace AppBundle\Controller\Api;

use AppBundle\Controller\ServicesTrait;
use FOS\RestBundle\Controller\FOSRestController;

abstract class BaseApiController extends FOSRestController
{
    use ServicesTrait;
}
