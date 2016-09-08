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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Gatepass", mappedBy="item")
     */
    private $gatepass;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->gatepass = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Add gatepass
     *
     * @param \AppBundle\Entity\Gatepass $gatepass
     *
     * @return Items
     */
    public function addGatepass(\AppBundle\Entity\Gatepass $gatepass)
    {
        $this->gatepass[] = $gatepass;

        return $this;
    }

    /**
     * Remove gatepass
     *
     * @param \AppBundle\Entity\Gatepass $gatepass
     */
    public function removeGatepass(\AppBundle\Entity\Gatepass $gatepass)
    {
        $this->gatepass->removeElement($gatepass);
    }

    /**
     * Get gatepass
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGatepass()
    {
        return $this->gatepass;
    }
}
