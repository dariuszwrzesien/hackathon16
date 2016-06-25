<?php

namespace AppBundle\Entity;

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

    public function getLatitude() {
        return $this->latitude;
    }

    public function getLongitude() {
        return $this->longitude;
    }

    public function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    public function setLongitude($longitude) {
        $this->longitude = $longitude;
    }
}