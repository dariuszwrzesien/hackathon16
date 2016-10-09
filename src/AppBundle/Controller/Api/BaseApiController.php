<?php

namespace AppBundle\Controller\Api;

use AppBundle\Controller\ServicesTrait;
use FOS\RestBundle\Controller\FOSRestController;

abstract class BaseApiController extends FOSRestController
{
    use ServicesTrait;

    /**
     * @param $type
     * @return \Symfony\Component\Validator\ConstraintViolationList
     */
    public function validate($type)
    {
        /**
         * @var $violations \Symfony\Component\Validator\ConstraintViolationList
         */
        $violations = $this->get('validator')->validate($type);
        $errors = [];

        if ($violations->count()) {
            /**
             * @var $violation \Symfony\Component\Validator\ConstraintViolation
             */
            foreach ($violations as $violation) {
                $errors[$violation->getPropertyPath()] = $violation->getMessage();
            }
        }

        return $errors;
    }
}
