<?php
/**
 * Created by PhpStorm.
 * User: muffin
 * Date: 04.08.18
 * Time: 17:39
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Foreman
 * @package AppBundle\Entity
 * @ORM\Entity()
 */
class Foreman extends User
{

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
        return ['SUPER_USER'];
    }

}