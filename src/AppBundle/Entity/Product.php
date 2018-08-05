<?php
/**
 * Created by PhpStorm.
 * User: muffin
 * Date: 03.08.18
 * Time: 16:37
 */

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class Product
 * @package AppBundle\Entity
 * @ORM\Entity()
 */
class Product
{
    /**
     * @var integer
     * @ORM\Column(type = "integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string|null
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Заполните название")
     */
    protected $name;

    /**
     * @var ArrayCollection|Shift[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Shift", mappedBy="products")
     */
    protected $shifts;

    /**
     * @var string|null
     * @ORM\Column(type="integer")
     *
     * @Assert\NotBlank(message="Заполните количество коробок")
     */
    protected $quantity;

    /**
     * @var string|null
     * @ORM\Column(type = "integer")
     *
     * @Assert\NotBlank(message = "Заполните вес одной коробки")
     */
    protected $weight;

    public function __construct()
    {
        $this->shifts = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return Shift[]|ArrayCollection
     */
    public function getShifts()
    {
        return $this->shifts;
    }

    /**
     * @param Shift[]|ArrayCollection $shifts
     */
    public function setShifts($shifts)
    {
        $this->shifts = $shifts;
    }

    /**
     * @return null|string
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param null|string $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return null|string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param null|string $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }


}