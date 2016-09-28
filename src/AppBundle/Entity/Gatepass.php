<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Gatepass
 *
 * @ORM\Table(name="gatepass", indexes={@ORM\Index(name="gatepass_user_id_foreign", columns={"user_id"}), @ORM\Index(name="gatepass_gatepass_type_id_foreign", columns={"gatepass_type_id"}), @ORM\Index(name="gatepass_company_id_foreign", columns={"company_id"}), @ORM\Index(name="gatepass_national_id_foreign", columns={"national_id"}), @ORM\Index(name="gatepass_section_id_foreign", columns={"section_id"})})
 * @ORM\Entity
 */
class Gatepass
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
     * @ORM\Column(name="person", type="string", length=255, nullable=false)
     */
    private $person;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="from_date", type="date", nullable=false)
     */
    private $fromDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="to_date", type="date", nullable=false)
     */
    private $toDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="camera", type="boolean", nullable=false)
     */
    private $camera;

    /**
     * @var boolean
     *
     * @ORM\Column(name="laptop", type="boolean", nullable=false)
     */
    private $laptop;

    /**
     * @var boolean
     *
     * @ORM\Column(name="car", type="boolean", nullable=false)
     */
    private $car;

    /**
     * @var string
     *
     * @ORM\Column(name="car_no", type="string", length=255, nullable=true)
     */
    private $carNo;

    /**
     * @var string
     *
     * @ORM\Column(name="car_type", type="string", length=255, nullable=true)
     */
    private $carType;

    /**
     * @var string
     *
     * @ORM\Column(name="car_color", type="string", length=255, nullable=true)
     */
    private $carColor;

    /**
     * @var string
     *
     * @ORM\Column(name="reason", type="string", length=255, nullable=false)
     */
    private $reason;

    /**
     * @var string
     *
     * @ORM\Column(name="remarks", type="string", length=255, nullable=false)
     */
    private $remarks;

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
     * @var \AppBundle\Entity\Company
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Company")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     * })
     */
    private $company;

    /**
     * @var \AppBundle\Entity\GatepassType
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\GatepassType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gatepass_type_id", referencedColumnName="id")
     * })
     */
    private $gatepassType;

    /**
     * @var \AppBundle\Entity\National
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\National")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="national_id", referencedColumnName="id")
     * })
     */
    private $national;

    /**
     * @var \AppBundle\Entity\Section
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Section")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="section_id", referencedColumnName="id")
     * })
     */
    private $section;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Items", mappedBy="gatepass", cascade={"persist", "remove"})
     * )
     */
    private $items;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->items = new ArrayCollection();
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
     * Set person
     *
     * @param string $person
     *
     * @return Gatepass
     */
    public function setPerson($person)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return string
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Set fromDate
     *
     * @param \DateTime $fromDate
     *
     * @return Gatepass
     */
    public function setFromDate($fromDate)
    {
        $this->fromDate = $fromDate;

        return $this;
    }

    /**
     * Get fromDate
     *
     * @return \DateTime
     */
    public function getFromDate()
    {
        return $this->fromDate;
    }

    /**
     * Set toDate
     *
     * @param \DateTime $toDate
     *
     * @return Gatepass
     */
    public function setToDate($toDate)
    {
        $this->toDate = $toDate;

        return $this;
    }

    /**
     * Get toDate
     *
     * @return \DateTime
     */
    public function getToDate()
    {
        return $this->toDate;
    }

    /**
     * Set camera
     *
     * @param boolean $camera
     *
     * @return Gatepass
     */
    public function setCamera($camera)
    {
        $this->camera = $camera;

        return $this;
    }

    /**
     * Get camera
     *
     * @return boolean
     */
    public function getCamera()
    {
        return $this->camera;
    }

    /**
     * Set laptop
     *
     * @param boolean $laptop
     *
     * @return Gatepass
     */
    public function setLaptop($laptop)
    {
        $this->laptop = $laptop;

        return $this;
    }

    /**
     * Get laptop
     *
     * @return boolean
     */
    public function getLaptop()
    {
        return $this->laptop;
    }

    /**
     * Set car
     *
     * @param boolean $car
     *
     * @return Gatepass
     */
    public function setCar($car)
    {
        $this->car = $car;

        return $this;
    }

    /**
     * Get car
     *
     * @return boolean
     */
    public function getCar()
    {
        return $this->car;
    }

    /**
     * Set carNo
     *
     * @param string $carNo
     *
     * @return Gatepass
     */
    public function setCarNo($carNo)
    {
        $this->carNo = $carNo;

        return $this;
    }

    /**
     * Get carNo
     *
     * @return string
     */
    public function getCarNo()
    {
        return $this->carNo;
    }

    /**
     * Set carType
     *
     * @param string $carType
     *
     * @return Gatepass
     */
    public function setCarType($carType)
    {
        $this->carType = $carType;

        return $this;
    }

    /**
     * Get carType
     *
     * @return string
     */
    public function getCarType()
    {
        return $this->carType;
    }

    /**
     * Set carColor
     *
     * @param string $carColor
     *
     * @return Gatepass
     */
    public function setCarColor($carColor)
    {
        $this->carColor = $carColor;

        return $this;
    }

    /**
     * Get carColor
     *
     * @return string
     */
    public function getCarColor()
    {
        return $this->carColor;
    }

    /**
     * Set reason
     *
     * @param string $reason
     *
     * @return Gatepass
     */
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get reason
     *
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Set remarks
     *
     * @param string $remarks
     *
     * @return Gatepass
     */
    public function setRemarks($remarks)
    {
        $this->remarks = $remarks;

        return $this;
    }

    /**
     * Get remarks
     *
     * @return string
     */
    public function getRemarks()
    {
        return $this->remarks;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Gatepass
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
     * @return Gatepass
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
     * Set company
     *
     * @param \AppBundle\Entity\Company $company
     *
     * @return Gatepass
     */
    public function setCompany(\AppBundle\Entity\Company $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \AppBundle\Entity\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set gatepassType
     *
     * @param \AppBundle\Entity\GatepassType $gatepassType
     *
     * @return Gatepass
     */
    public function setGatepassType(\AppBundle\Entity\GatepassType $gatepassType = null)
    {
        $this->gatepassType = $gatepassType;

        return $this;
    }

    /**
     * Get gatepassType
     *
     * @return \AppBundle\Entity\GatepassType
     */
    public function getGatepassType()
    {
        return $this->gatepassType;
    }

    /**
     * Set common
     *
     * @param \AppBundle\Entity\National $national
     *
     * @return Gatepass
     */
    public function setNational(\AppBundle\Entity\National $national = null)
    {
        $this->national = $national;

        return $this;
    }

    /**
     * Get common
     *
     * @return \AppBundle\Entity\National
     */
    public function getNational()
    {
        return $this->national;
    }

    /**
     * Set section
     *
     * @param \AppBundle\Entity\Section $section
     *
     * @return Gatepass
     */
    public function setSection(\AppBundle\Entity\Section $section = null)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return \AppBundle\Entity\Section
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Gatepass
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }

    public function addItems(Items $item)
    {
        $this->items->add($item);
//        $item->setGatepass($this);
    }

    public function removeItems(Items $item) {

            $this->items->removeElement($item);
    }



}
