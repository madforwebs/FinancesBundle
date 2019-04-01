<?php

namespace FinanciaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\MappedSuperclass
 */
class Income
{

    /**
     * @var string
     *
     * @ORM\Column(name="concept", type="string", length=255, nullable=true)
     */
    private $concept;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float")
     */
    private $total;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_income", type="datetime", nullable=true)
     */
    private $dateIncome;




    /**
     * @var string
     * @ORM\Column(name="method", type="string", columnDefinition="enum('income','expenditure')" , nullable=false)
     */
    private $method;

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
     * Set concept
     *
     * @param string $concept
     *
     * @return Income
     */
    public function setConcept($concept)
    {
        $this->concept = $concept;

        return $this;
    }

    /**
     * Get concept
     *
     * @return string
     */
    public function getConcept()
    {
        return $this->concept;
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
    public function getDateIncome()
    {
        return $this->dateIncome;
    }

    /**
     * @param \DateTime $dateIncome
     */
    public function setDateIncome($dateIncome)
    {
        $this->dateIncome = $dateIncome;
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
    public function getAccountDestiny()
    {
        return $this->accountDestiny;
    }

    /**
     * @param mixed $accountDestiny
     */
    public function setAccountDestiny($accountDestiny)
    {
        $this->accountDestiny = $accountDestiny;
    }

    public function __toString()
    {
        return $this->getConcept()." - ".$this->getTotal();
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return mixed
     */
    public function getLinkedIncome()
    {
        return $this->linkedIncome;
    }

    /**
     * @param mixed $linkedIncome
     */
    public function setLinkedIncome($linkedIncome)
    {
        $this->linkedIncome = $linkedIncome;
    }
}

