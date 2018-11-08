<?php

namespace MadForWebs\BookingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 */
class BookingPass
{


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePass", type="date")
     */
    private $datePass;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timePass", type="time")
     */
    private $timePass;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getBookings()
    {
        return $this->bookings;
    }

    /**
     * Set datePass
     *
     * @param \DateTime $datePass
     *
     * @return BookingPass
     */
    public function setDatePass($datePass)
    {
        $this->datePass = $datePass;

        return $this;
    }

    /**
     * Get datePass
     *
     * @return \DateTime
     */
    public function getDatePass()
    {
        return $this->datePass;
    }

    /**
     * Set timePass
     *
     * @param \DateTime $timePass
     *
     * @return BookingPass
     */
    public function setTimePass($timePass)
    {
        $this->timePass = $timePass;

        return $this;
    }

    /**
     * Get timePass
     *
     * @return \DateTime
     */
    public function getTimePass()
    {
        return $this->timePass;
    }
}

