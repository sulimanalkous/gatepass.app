<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Items
 *
 * @ORM\Table(name="items")
 * @ORM\Entity
 */
class Items
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="srlno", type="string", length=255, nullable=true)
     */
    private $srlno;

    /**
     * @var Decimal
     *
     * @ORM\Column(name="qty", type="decimal", precision=10, scale=2)
     */
    private $qty;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Gatepass", inversedBy="items")
     * @ORM\JoinColumn(name="gatepass_id", referencedColumnName="id")
     */
    private $gatepass;




    /**
     * Constructor
     */
    public function __construct()
    {
    }


    /**
     * Get id
     *
     * @return integer
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
     * @return Items
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

    /**
     * Set srlno
     *
     * @param string $srlno
     *
     * @return Items
     */
    public function setSrlno($srlno)
    {
        $this->srlno = $srlno;

        return $this;
    }

    /**
     * Get srlno
     *
     * @return string
     */
    public function getSrlno()
    {
        return $this->srlno;
    }

    /**
     * @return Decimal
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * @param Decimal $qty
     */
    public function setQty($qty)
    {
        $this->qty = $qty;
    }

    /**
     * @return mixed
     */
    public function getGatepass()
    {
        return $this->gatepass;
    }

    /**
     * @param mixed $gatepass
     */
    public function setGatepass($gatepass)
    {
        $this->gatepass = $gatepass;
    }



    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Items
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Items
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    function __toString()
    {
        return $this->name;
    }


}
