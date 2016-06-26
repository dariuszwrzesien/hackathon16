<?php

namespace AppBundle\Entity;

class Status {
    const WAITING = 1;
    const IN_PROGRESS = 2;
    const CLOSED = 3;
    const CANCELED = 4;
    static private $statusNames = [
        self::WAITING => 'waiting',
        self::IN_PROGRESS => 'in progress',
        self::CANCELED => 'canceled',
        self::CLOSED => 'closed',
    ];

    static private $allowedTransitions = [
        self::WAITING => [self::IN_PROGRESS, self::CANCELED],
        self::IN_PROGRESS => [self::CLOSED, self::CANCELED],
        self::CANCELED => [],
        self::CLOSED => [],
    ];

    /**
     * Checks whether transition to a new status is allowed.
     *
     * @param int|null $oldStatus
     * @param int $newStatus
     * @return bool
     */
    static public function isTransitionAllowed($oldStatus, int $newStatus)
    {
        if ($oldStatus === null) {
            if ($newStatus !== self::WAITING) {
                throw new \InvalidArgumentException('New tickets can only have status set to Waiting.');
            } else {
                return true;
            }
        }
        if (!array_key_exists($oldStatus, self::$allowedTransitions)) {
            throw new \InvalidArgumentException('Current status is invalid');
        }

        return in_array($newStatus, self::$allowedTransitions[$oldStatus], true);
    }

    /**
     * @param $statusId
     * @return string
     */
    static public function getStatusName($statusId)
    {
        if (array_key_exists($statusId, self::$statusNames)) {
            return self::$statusNames[$statusId];
        }
        else {
            return 'unknown';
        }
    }
}