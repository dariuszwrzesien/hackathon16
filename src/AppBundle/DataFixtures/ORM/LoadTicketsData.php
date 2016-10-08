<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Ticket;
use AppBundle\Entity\Category;
use AppBundle\Entity\Location;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTicketsData implements FixtureInterface
{
    const TICKETS_AMOUNT = 200;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $dateTime = new \DateTime();

        $category = new Category();
        $category->setName('testTicket');
        $manager->persist($category);

        $location = new Location();
        $location->setLatitude(123);
        $location->setLongitude(123);

        for ($i = 1; $i < self::TICKETS_AMOUNT; $i++) {
            $timeStamp = $dateTime->add(new \DateInterval('PT'.$i.'M'));

            $ticket = new Ticket();
            $ticket->setCategory($category);
            $ticket->setDescription('test ticket description '.$i);
            $ticket->setCreated($timeStamp);
            $ticket->setUpdated($timeStamp);
            $ticket->setStatus(Ticket::WAITING);
            $ticket->setLocation($location);
            $manager->persist($ticket);

            $comment = new Comment();
            $comment->setDescription('test comment description'.$i);
            $comment->setTicket($ticket);
            $comment->setCreated($timeStamp);
            $manager->persist($comment);
        }

        $manager->flush();
    }
}