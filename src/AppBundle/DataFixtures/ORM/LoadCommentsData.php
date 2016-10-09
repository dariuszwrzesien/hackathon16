<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Ticket;
use AppBundle\Entity\Category;
use AppBundle\Entity\Location;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCommentsData implements FixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $timeStamp = new \DateTime();

        $prefillComments = [
            1 => 'Komentarz pierwszy',
            2 => 'Komentarz drugi',
            3 => 'Komentarz trzeci',
            4 => 'Komentarz czwarty'
        ];

        $category = new Category();
        $category->setName('testComment');
        $manager->persist($category);

        $location = new Location();
        $location->setLatitude(123);
        $location->setLongitude(123);

        $ticket = new Ticket();
        $ticket->setCategory($category);
        $ticket->setDescription('test description');
        $ticket->setCreated($timeStamp);
        $ticket->setUpdated($timeStamp);
        $ticket->setStatus(Ticket::WAITING);
        $ticket->setLocation($location);
        $manager->persist($ticket);

        foreach ($prefillComments as $comId => $comDesc) {
            $comment = new Comment();
            $comment->setDescription($comDesc);
            $comment->setTicket($ticket);
            $comment->setCreated($timeStamp);
            $manager->persist($comment);
        }

        $manager->flush();
    }
}