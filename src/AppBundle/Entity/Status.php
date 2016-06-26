<?php

namespace AppBundle\Entity;

class Status {
    const WAITING = 1;
    const IN_PROGRESS = 2;
    const CLOSED = 3;
    const CANCELED = 4;

    static private $allowedTransitions = [
        self::WAITING => [self::IN_PROGRESS, self::CANCELED],
        self::IN_PROGRESS => [self::CLOSED, self::CANCELED],
        self::CANCELED => [],
        self::CLOSED => [],
    ];

    /**
     * Checks whether transition to a new status is allowed.
     *
     * @param int $oldStatus
     * @param int $newStatus
     * @return bool
     */
    static public function isTransitionAllowed(int $oldStatus, int $newStatus)
    {
        if (!array_key_exists($oldStatus, self::$allowedTransitions)) {
            throw new \InvalidArgumentException('Current status is invalid');
        }

        return in_array($newStatus, self::$allowedTransitions, true);
    }
}