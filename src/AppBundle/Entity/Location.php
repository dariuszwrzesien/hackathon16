<?php

namespace DomainBundle;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Location {
    /**
     * @ORM\Column(type="decimal",precision=18,scale=12)
     */
    public $latitude;

    /**
     * @ORM\Column(type="decimal",precision=18,scale=12)
     */
    public $longitude;
}