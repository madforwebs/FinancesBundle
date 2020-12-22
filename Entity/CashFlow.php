<?php

namespace MadForWebs\FinancialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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

}

