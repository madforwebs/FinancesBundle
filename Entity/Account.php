<?php

namespace MadForWebs\FinancialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\MappedSuperclass
 */
class Account
{

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var float
     *
     * @ORM\Column(name="balance", type="float",precision=2)
     */
    protected $balance;


    public function totalEarnings()
    {
        $sum = 0;

        if (count($this->getEarnings())) {
            /** @var Income $earning */
            foreach ($this->getEarnings() as $earning) {
                $sum += $earning->getTotal();
            }
        }

        return $sum;
    }

    public function totalExpenditures()
    {
        $sum = 0;
        if (count($this->getExpenditures())) {
            /** @var Expenditure $earning */
            foreach ($this->getExpenditures() as $earning) if ($earning->getStatus() == 'paid') {
                $sum += $earning->getTotal();
            }
        }
        return $sum;
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


    /**
     * Set balance
     *
     * @param float $balance
     *
     * @return Account
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return float
     */
    public function getBalance()
    {
        return $this->balance;
    }

    public function __toString()
    {
        return ($this->getName() == '') ? '' : $this->getName();
    }

    /**
     * @return mixed
     */
    public function getExpenditures()
    {
        return $this->expenditures;
    }

    /**
     * @param mixed $expenditures
     */
    public function setExpenditures($expenditures)
    {
        $this->expenditures = $expenditures;
    }

    /**
     * @return mixed
     */
    public function getEarnings()
    {
        return $this->earnings;
    }

    /**
     * @param mixed $earnings
     */
    public function setEarnings($earnings)
    {
        $this->earnings = $earnings;
    }

    public function addEarning($earning)
    {
        $this->earnings[] = $earning;
    }

    public function removeEarning($earning)
    {
        $this->earnings->removeElement($earning);
    }

    public function addExpenditure($expenditure)
    {
        $this->expenditures[] = $expenditure;
    }

    public function removeExpenditure($expenditure)
    {
        $this->expenditures->removeElement($expenditure);
    }


    /**
     * @return mixed
     */
    public function getEarningsOrigins()
    {
        return $this->earningsOrigins;
    }

    /**
     * @param mixed $earningsOrigins
     */
    public function setEarningsOrigins($earningsOrigins)
    {
        $this->earningsOrigins = $earningsOrigins;
    }

    public function addEarningOrigin($earningOrigin)
    {
        $this->earningsOrigins[] = $earningOrigin;
    }

    public function removeEarningOrigin($earningOrigin)
    {
        $this->earningsOrigins->removeElement($earningOrigin);
    }

}

