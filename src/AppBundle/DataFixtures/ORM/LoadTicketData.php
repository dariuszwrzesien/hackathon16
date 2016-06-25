<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Location;
use AppBundle\Entity\Ticket;
use DateTime;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTicketData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $ticket = new Ticket();
        $ticket->setDescription('Lorem ...');
        $ticket->setCreated(new DateTime());
        $ticket->setStatus(1);

        $location = new Location();
        $location->setLatitude(10.0);
        $location->setLongitude(10.0);

        $ticket->setLocation($location);

        $manager->persist($ticket);
        $manager->flush();
    }
}