<?php

namespace FinanciaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\MappedSuperclass
 */
class Expenditure
{


    /**
     * @var float
     *
     * @ORM\Column(name="quantity", type="float")
     */
    private $quantity;

    /**
     * @var float
     *
     * @ORM\Column(name="vat", type="float", nullable=true))
     */
    private $vat;

    /**
     * @var float
     *
     * @ORM\Column(name="irpf", type="float", nullable=true))
     */
    private $irpf;


    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float", nullable=true))
     */
    private $total;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", columnDefinition="enum('pending','paid')")
     */
    private $status;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_buy", type="datetime", nullable=true)
     */
    private $dateBuy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_paid", type="datetime", nullable=true)
     */
    private $datePaid;


    /**
     * @var string
     * @ORM\Column(name="concept", type="string", nullable=true)
     */
    private $concept;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;




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

    /**
     * Set quantity
     *
     * @param float $quantity
     *
     * @return Expenditure
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Expenditure
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param mixed $provider
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
    }

    /**
     * @return float
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * @param float $vat
     */
    public function setVat($vat)
    {
        $this->vat = $vat;
    }

    /**
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param float $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
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
     * @return string
     */
    public function getWayToPay()
    {
        return $this->wayToPay;
    }

    /**
     * @param string $wayToPay
     */
    public function setWayToPay($wayToPay)
    {
        $this->wayToPay = $wayToPay;
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
     * @return mixed
     */
    public function getConcept()
    {
        return $this->concept;
    }

    /**
     * @param mixed $concept
     */
    public function setConcept($concept)
    {
        $this->concept = $concept;
    }

    /**
     * @return mixed
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param mixed $account
     */
    public function setAccount($account)
    {
        $this->account = $account;
    }


    /**
     * @return float
     */
    public function getIrpf()
    {
        return $this->irpf;
    }

    /**
     * @param float $irpf
     */
    public function setIrpf($irpf)
    {
        $this->irpf = $irpf;
    }

}

