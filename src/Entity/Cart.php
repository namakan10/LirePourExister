<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CartRepository")
 */
class Cart
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Book", inversedBy="carts")
     */
    private $Book;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Member", cascade={"persist", "remove"})
     */
    private $member;

    public function __construct()
    {
        $this->Book = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBook(): Collection
    {
        return $this->Book;
    }

    public function addBook(Book $book): self
    {
        if (!$this->Book->contains($book)) {
            $this->Book[] = $book;
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        if ($this->Book->contains($book)) {
            $this->Book->removeElement($book);
        }

        return $this;
    }

    public function getMember(): ?Member
    {
        return $this->member;
    }

    public function setMember(?Member $member): self
    {
        $this->member = $member;

        return $this;
    }
}
