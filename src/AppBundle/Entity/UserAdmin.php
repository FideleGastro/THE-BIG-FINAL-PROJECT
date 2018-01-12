<?php

namespace AppBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 *
 * @ORM\Table(name="user_admin")
 */

class UserAdmin extends BaseUser
{

    /**
     * @var integer
     *
     * @ORM\Id
     *
     * @ORM\Column(type="integer")
     *
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */

    protected $id;

    /**
     * UserAdmin constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }


}