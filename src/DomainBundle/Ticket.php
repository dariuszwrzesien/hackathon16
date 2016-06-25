<?php

namespace DomainBundle;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Entity
 */
class Ticket {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=250)
     */
    public $description;

    /**
     * @ORM\Column(type="datetime")
     */
    public $created;

    /**
     * @ORM\Column(type="integer")
     */
    public $status;

    /**
     * @ORM\Embedded(class="Location")
     */
    public $location;

    /**
     * @ORM\ManyToOne(targetEntity="Category")
     */
    public $category;

    /**
     * @ORM\OneToMany(targetEntity="Attachment", mappedBy="ticket")
     */
    public $attachments;

    public function __construct() {
        $this->attachments = new ArrayCollection();
    }

    public function createNewTicket(string $description, Location $location, Category $category) {
        $ticket = new Ticket();

        $ticket->created = new DateTime();
        $ticket->description = $description;
        $ticket->status = Status::WAITING;
        $ticket->location = $location;
        $ticket->category = $category;

        return $ticket;
    }

    public function appendAttachment(Attachment $attachment) {
        $this->attachments[] = $attachment;
    }

    public function start() {
        $this->status = Status::IN_PROGRESS;
    }

    public function close() {
        $this->status = Status::CLOSED;
    }

    public function cancel() {
        $this->cancel = Status::CANCELED;
    }
}

