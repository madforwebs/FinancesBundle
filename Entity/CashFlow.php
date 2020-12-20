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
    private $concept;

    /**
     * @var float
     *
     * @ORM\Column(name="quantity", type="float")
     */
    private $quantity;

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
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

}

