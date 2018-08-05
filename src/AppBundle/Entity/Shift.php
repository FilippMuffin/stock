<?php
/**
 * Created by PhpStorm.
 * User: muffin
 * Date: 01.08.18
 * Time: 15:41
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Shift
 * @package AppBundle\Entity
 * @ORM\Entity()
 */
class Shift
{
    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     *
     */
    protected $date;

    /**
     * @var Employee|null
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Employee", inversedBy="shifts")
     */
    protected $employees;

    /**
     * @var Product|null
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product", inversedBy="shifts")
     */
    protected $products;

    /**
     * @var integer|null
     * @ORM\Column(type="integer")
     *
     * @Assert\NotBlank(message="Введите количество")
     */
    protected $quantity;

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
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return Employee|null
     */
    public function getEmployees()
    {
        return $this->employees;
    }

    /**
     * @param Employee|null $employees
     */
    public function setEmployees(Employee $employees)
    {
        $this->employees = $employees;
    }


    /**
     * @return Product|null
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param Product|null $products
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }

    /**
     * @return int|null
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int|null $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }


}