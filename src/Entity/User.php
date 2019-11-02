<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\OneToOne(targetEntity="App\Entity\Member", mappedBy="user", cascade={"persist", "remove"})
     */
    private $member;




    public function __construct()
    {
        parent::__construct();
        //your logic
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMember(): ?Member
    {
        return $this->member;
    }

    public function setMember(?Member $member): self
    {
        $this->member = $member;

        // set (or unset) the owning side of the relation if necessary
        $newUser = null === $member ? null : $this;
        if ($member->getUser() !== $newUser) {
            $member->setUser($newUser);
        }

        return $this;
    }


}
