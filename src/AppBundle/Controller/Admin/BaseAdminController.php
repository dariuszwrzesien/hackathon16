<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\ServicesTrait;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class BaseAdminController extends Controller
{
    use ServicesTrait;
}
