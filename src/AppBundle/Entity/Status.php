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

    static private $actionNames = [
        self::WAITING => 'Start progress',
        self::IN_PROGRESS => 'Done'
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
     *
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
     * @param int $statusId
     *
     * @return string
     */
    static public function getStatusName(int $statusId)
    {
        return self::getName($statusId, self::$statusNames);
    }

    /**
     * @param int $statusId
     *
     * @return string
     */
    static public function getActionName(int $statusId)
    {
        return self::getName($statusId, self::$actionNames);
    }

    /**
     * @param int $statusId
     *
     * @return int
     */
    static public function getNextAction(int $statusId)
    {
        return $statusId + 1;
    }

    /**
     * @param int $statusId
     * @param array $type
     *
     * @return string
     */
    static private function getName(int $statusId, array $type)
    {
        if (array_key_exists($statusId, $type)) {
            return $type[$statusId];
        } else {
            return 'unknown';
        }
    }
}
