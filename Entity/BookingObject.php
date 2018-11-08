<?php

namespace MadForWebs\BookingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookingObject
 *
 * @ORM\Table(name="booking_object")
 * @ORM\Entity(repositoryClass="MadForWebs\BookingBundle\Repository\BookingObjectRepository")
 */
class BookingObject
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
     * @ORM\OneToMany(targetEntity="BookingPass", mappedBy="bookingsPasses", cascade={"all"})
     */
    private $bookingsPasses;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_start", type="datetime")
     */
    private $dateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_end", type="datetime")
     */
    private $dateEnd;

    /**
     * @var array
     *
     * @ORM\Column(name="hour_of_rest", type="array")
     */
    private $hourOfRest;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="duration_of_pass", type="time")
     */
    private $durationOfPass;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="max_companions", type="integer")
     */
    private $maxCompanions;


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
    public function getBookingsPasses()
    {
        return $this->bookingsPasses;
    }

    /**
     * @param mixed $bookingsPasses
     */
    public function setBookingsPasses($bookingsPasses)
    {
        $this->bookingsPasses = $bookingsPasses;
    }



    /**
     * Set dateStart
     *
     * @param \DateTime $dateStart
     *
     * @return BookingObject
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     *
     * @return BookingObject
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set hourOfRest
     *
     * @param array $hourOfRest
     *
     * @return BookingObject
     */
    public function setHourOfRest($hourOfRest)
    {
        $this->hourOfRest = $hourOfRest;

        return $this;
    }

    /**
     * Get hourOfRest
     *
     * @return array
     */
    public function getHourOfRest()
    {
        return $this->hourOfRest;
    }

    /**
     * @return \DateTime
     */
    public function getDurationOfPass()
    {
        return $this->durationOfPass;
    }

    /**
     * @param \DateTime $durationOfPass
     */
    public function setDurationOfPass($durationOfPass)
    {
        $this->durationOfPass = $durationOfPass;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return BookingObject
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return BookingObject
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
     * Set maxCompanions
     *
     * @param integer $maxCompanions
     *
     * @return BookingObject
     */
    public function setMaxCompanions($maxCompanions)
    {
        $this->maxCompanions = $maxCompanions;

        return $this;
    }

    /**
     * Get maxCompanions
     *
     * @return int
     */
    public function getMaxCompanions()
    {
        return $this->maxCompanions;
    }
}

