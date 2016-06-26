<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Status;
use AppBundle\Entity\Ticket;

class StatusTest extends \PHPUnit_Framework_TestCase
{

    /**
     * These are statuses that are not allowed as a starting status for a new Ticket
     *
     * @return array
     */
    public function expectedExceptionsOnTicketCreation()
    {
        return [
            [Status::CLOSED],
            [Status::CANCELED],
            [Status::IN_PROGRESS]
        ];
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @dataProvider expectedExceptionsOnTicketCreation
     */
    public function newTicketStatusOtherThanWaitingWillThrowException($newStatus)
    {
        $ticket = new Ticket();
        $ticket->setStatus($newStatus);
    }

    /**
     * @test
     */
    public function newTicketStatusWaitingIsAcceptable()
    {
        $ticket = new Ticket();
        $ticket->setStatus(Status::WAITING);

        $this->assertEquals(Status::WAITING, $ticket->getStatus());
    }


    public function transitionsTestData()
    {
        return [
            [Status::WAITING, Status::IN_PROGRESS, true],
            [Status::WAITING, Status::CANCELED, true],
            [Status::WAITING, Status::CLOSED, false],
            [Status::IN_PROGRESS, Status::CLOSED, true],
            [Status::IN_PROGRESS, Status::CANCELED, true],
            [Status::IN_PROGRESS, Status::WAITING, false],
        ];
    }

    /**
     * @test
     * @dataProvider transitionsTestData
     *
     * @param int $oldStatus
     * @param int $newStatus
     * @param bool $expectedResult
     */
    public function onlyCertainTicketTransitionsAreAllowed($oldStatus, $newStatus, $expectedResult)
    {
        $this->assertEquals(Status::isTransitionAllowed($oldStatus, $newStatus), $expectedResult);
    }

    /**
     * @test
     */
    public function canceledAndClosedTicketsStatusCannotBeChanged()
    {
        foreach ([Status::CLOSED, Status::CANCELED] as $oldStatus) {
            foreach ([Status::WAITING, Status::IN_PROGRESS, Status::CANCELED, Status::CLOSED] as $newStatus) {
                $this->assertEquals(Status::isTransitionAllowed($oldStatus, $newStatus), false);
            }
        }
    }
}