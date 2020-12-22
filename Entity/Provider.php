<?php

namespace MadForWebs\FinancialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\MappedSuperclass
 */
class Provider
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
     * @ORM\Column(name="irpf", type="float", nullable=true)
     */
    protected $irpf;


    /**
     * @var float
     *
     * @ORM\Column(name="balance", type="float", nullable=true)
     */
    protected $balance;




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
     * Set name
     *
     * @param string $name
     *
     * @return Provider
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function __toString()
    {
        return (null == $this->getName()) ? '' : $this->getName();
        // TODO: Implement __toString() method.
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

    public function addExpenditure($expenditure)
    {
        $this->expenditures[] = $expenditure;
    }

    public function removeExpenditure($expenditure)
    {
        $this->expenditures->removeElement($expenditure);
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

    /**
     * @return float
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param float $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }



}

