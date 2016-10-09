<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Location
{
    /**
     * @ORM\Column(type="decimal", precision=18, scale=12)
     */
    public $latitude;

    /**
     * @ORM\Column(type="decimal", precision=18, scale=12)
     */
    public $longitude;

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param float $latitude
     * @return Location
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @param float $longitude
     * @return Location
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }
}