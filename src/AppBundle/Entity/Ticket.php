<?php

namespace AppBundle\Entity;

use AppBundle\TicketRepository;
use ArrayObject;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="AppBundle\TicketRepository")
 */
class Ticket
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var Location
     *
     * @ORM\Embedded(class="Location")
     */
    private $location;

    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="Category")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="ticket")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="Attachment", mappedBy="ticket")
     */
    private $attachments;

    /**
     * @ORM\OneToOne(targetEntity="Notifier",  mappedBy="ticket", cascade={"all"}))
     */
    private $notifier;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Ticket
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set created
     *
     * @param DateTime $created
     *
     * @return Ticket
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

    /**
     * Set updated
     *
     * @param DateTime $updated
     *
     * @return Ticket
     */
    public function setUpdated(DateTime $updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set status
     *
     * @param integer $newStatus
     *
     * @return Ticket
     */
    public function setStatus($newStatus)
    {
        if (Status::isTransitionAllowed($this->status, $newStatus)) {
            $this->status = $newStatus;
        } else {
            throw new \InvalidArgumentException("This status change is not allowed.");
        }

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set location
     *
     * @param Location $location
     *
     * @return Ticket
     */
    public function setLocation(Location $location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set category
     *
     * @param Category $category
     *
     * @return Ticket
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getCategoryName()
    {
        return $this->getCategory()->getName();
    }

    /**
     * @return string
     */
    public function getStatusName()
    {
        return Status::getStatusName($this->getStatus());
    }

    /**
     * Set comments
     *
     * @param ArrayCollection $comments
     *
     * @return Ticket
     */
    public function setComments(ArrayCollection $comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set attachments
     *
     * @param ArrayObject $attachments
     *
     * @return Ticket
     */
    public function setAttachments(ArrayObject $attachments)
    {
        $this->attachments = $attachments;

        return $this;
    }

    /**
     * Get attachments
     *
     * @return ArrayObject
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * @param Notifier $notifier
     * @return $this
     */
    public function setNotifier(Notifier $notifier)
    {
        $this->notifier = $notifier;

        return $this;
    }

    /**
     * @return Notifier
     */
    public function getNotifier()
    {
        return $this->notifier;
    }
}

