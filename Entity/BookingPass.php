<?php

namespace MadForWebs\BookingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookingPass
 *
 * @ORM\Table(name="booking_pass")
 * @ORM\Entity(repositoryClass="MadForWebs\BookingBundle\Repository\BookingPassRepository")
 */
class BookingPass
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
     * @ORM\OneToMany(targetEntity="Booking", mappedBy="bookingPass", cascade={"all"})
     * @ORM\OrderBy({"dateIssue"="ASC"})
     */
    private $bookings;

    /**
     * @ORM\ManyToOne(targetEntity="BookingObject", inversedBy="bookingsPasses", cascade={"persist"})
     * @ORM\JoinColumn(name="bookingObject", referencedColumnName="id", nullable=false)
     */
    private $bookingObject;

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
     * @param mixed $bookings
     */
    public function setBookings($bookings)
    {
        $this->bookings = $bookings;
    }

    /**
     * @return mixed
     */
    public function getBookingObject()
    {
        return $this->bookingObject;
    }

    /**
     * @param mixed $bookingObject
     */
    public function setBookingObject($bookingObject)
    {
        $this->bookingObject = $bookingObject;
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

