<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Ticket;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Comment {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\ManyToOne(targetEntity="Ticket", inversedBy="comments")
     * @ORM\JoinColumn(name="ticket_id", referencedColumnName="id")
     */
    public $ticket;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    public $description;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set Description
     *
     * @param string $description
     *
     * @return Attachment
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get Description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set ticket
     *
     * @param Ticket $ticket
     *
     * @return Comments
     */
    public function setTicket(Ticket $ticket = null)
    {
        $this->ticket = $ticket;

        return $this;
    }

    /**
     * Get ticket
     *
     * @return Ticket
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * Set created
     *
     * @param DateTime $created
     *
     * @return Comment
     */
    public function setCreated(DateTime $created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }
}
