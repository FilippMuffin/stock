<?php
/**
 * Created by PhpStorm.
 * User: muffin
 * Date: 01.08.18
 * Time: 15:58
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class Employee
 * @package AppBundle\Entity
 * @ORM\Entity()
 */
class Employee extends User
{
    /**
     * @var ArrayCollection|Shift[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Shift", mappedBy="employees")
     */
    protected $shifts;


    public function __construct()
    {
        $this->shifts = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name.', '.$this->surname;
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
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return ['USER'];
    }

}