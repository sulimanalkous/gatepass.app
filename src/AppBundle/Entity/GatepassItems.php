<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GatepassItems
 *
 * @ORM\Table(name="gatepass_items")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GatepassItemsRepository")
 */
class GatepassItems
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
     * @var \AppBundle\Entity\Gatepass
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Gatepass")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gatepass_id", referencedColumnName="id")
     * })
     */
    private $gatepass;

    /**
     * @var \AppBundle\Entity\Items
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Items")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="items_id", referencedColumnName="id")
     * })
     */
    private $items;

    /**
     * @var string
     *
     * @ORM\Column(name="qty", type="decimal", precision=10, scale=0)
     */
    private $qty;

    /**
     * @var string
     *
     * @ORM\Column(name="unit", type="string", length=120, nullable=true)
     */
    private $unit;


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
     * Set qty
     *
     * @param string $qty
     *
     * @return GatepassItems
     */
    public function setQty($qty)
    {
        $this->qty = $qty;

        return $this;
    }

    /**
     * Get qty
     *
     * @return string
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * Set unit
     *
     * @param string $unit
     *
     * @return GatepassItems
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
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
     * @return Items
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param Items $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }


}

