<?php
// src/AppBundle/Entity/User.php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(name="lastname", type="string", length=150, nullable=true)
     * @var type 
     */
    private $lastname;
    
    /**
     * @ORM\Column(name="firstname", type="string", length=150, nullable=true)
     * @var type 
     */
    private $firstname;
    
/**
 * @ORM\ManyToMany(targetEntity="User", mappedBy="myFriends")
 */
protected $friendsWithMe;

/**
 * @ORM\ManyToMany(targetEntity="User", inversedBy="friendsWithMe")
 * @ORM\JoinTable(name="friends",
 *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
 *     inverseJoinColumns={@ORM\JoinColumn(name="friend_user_id", referencedColumnName="id")}
 * )
 */
protected $myFriends;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Add friendsWithMe
     *
     * @param \UserBundle\Entity\User $friendsWithMe
     *
     * @return User
     */
    public function addFriendsWithMe(\UserBundle\Entity\User $friendsWithMe)
    {
        $this->friendsWithMe[] = $friendsWithMe;

        return $this;
    }

    /**
     * Remove friendsWithMe
     *
     * @param \UserBundle\Entity\User $friendsWithMe
     */
    public function removeFriendsWithMe(\UserBundle\Entity\User $friendsWithMe)
    {
        $this->friendsWithMe->removeElement($friendsWithMe);
    }

    /**
     * Get friendsWithMe
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFriendsWithMe()
    {
        return $this->friendsWithMe;
    }

    /**
     * Add myFriend
     *
     * @param \UserBundle\Entity\User $myFriend
     *
     * @return User
     */
    public function addMyFriend(\UserBundle\Entity\User $myFriend)
    {
        $this->myFriends[] = $myFriend;

        return $this;
    }

    /**
     * Remove myFriend
     *
     * @param \UserBundle\Entity\User $myFriend
     */
    public function removeMyFriend(\UserBundle\Entity\User $myFriend)
    {
        $this->myFriends->removeElement($myFriend);
    }

    /**
     * Get myFriends
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMyFriends()
    {
        return $this->myFriends;
    }
}
