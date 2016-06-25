<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Attachment {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\ManyToOne(targetEntity="Ticket", inversedBy="attachments")
     * @ORM\JoinColumn(name="ticket_id", referencedColumnName="id")
     */
    public $ticket;

    /**
     * @ORM\Column(type="string", length=250)
     */
    public $path;
}