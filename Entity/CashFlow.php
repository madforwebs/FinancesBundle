<?php

namespace MadForWebs\FinancialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\MappedSuperclass
 */
class CashFlow
{


    /**
     * @var string
     * @ORM\Column(name="concept", type="string", nullable=true)
     */
    protected $concept;

    /**
     * @var float
     *
     * @ORM\Column(name="quantity", type="float")
     */
    protected $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", columnDefinition="enum('pending','paid')")
     */
    protected $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_buy", type="datetime", nullable=true)
     */
    protected $dateBuy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_paid", type="datetime", nullable=true)
     */
    protected $datePaid;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    protected $updatedAt;

    /**
     * @return string
     */
    public function getConcept()
    {
        return $this->concept;
    }

    /**
     * @param string $concept
     */
    public function setConcept($concept)
    {
        $this->concept = $concept;
    }

    /**
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param float $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return \DateTime
     */
    public function getDateBuy()
    {
        return $this->dateBuy;
    }

    /**
     * @param \DateTime $dateBuy
     */
    public function setDateBuy($dateBuy)
    {
        $this->dateBuy = $dateBuy;
    }

    /**
     * @return \DateTime
     */
    public function getDatePaid()
    {
        return $this->datePaid;
    }

    /**
     * @param \DateTime $datePaid
     */
    public function setDatePaid($datePaid)
    {
        $this->datePaid = $datePaid;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }


    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->setCreatedAt(new \DateTime('now'));
        $this->setUpdatedAt(new \DateTime('now'));
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->setUpdatedAt(new \DateTime('now'));
    }
}

