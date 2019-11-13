<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BorrowRepository")
 */
class Borrow
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_borrow;

    /**
     * @ORM\Column(type="date")
     */
    private $return_dt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Book", inversedBy="borrows")
     */
    private $book;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Member", inversedBy="borrows")
     */
    private $member;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isValid = false;

    /**
     * @ORM\Column(type="date")
     */
    private $reservation_dt;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $numBrorrow;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateBorrow(): ?\DateTimeInterface
    {
        return $this->date_borrow;
    }

    public function setDateBorrow(\DateTimeInterface $date_borrow): self
    {
        $this->date_borrow = $date_borrow;

        return $this;
    }

    public function getReturnDt(): ?\DateTimeInterface
    {
        return $this->return_dt;
    }

    public function setReturnDt(\DateTimeInterface $return_dt): self
    {
        $this->return_dt = $return_dt;

        return $this;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): self
    {
        $this->book = $book;

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

    public function getIsValid(): ?bool
    {
        return $this->isValid;
    }

    public function setIsValid(bool $isValid): self
    {
        $this->isValid = $isValid;

        return $this;
    }

    public function getReservationDt(): ?\DateTimeInterface
    {
        return $this->reservation_dt;
    }

    public function setReservationDt(\DateTimeInterface $reservation_dt): self
    {
        $this->reservation_dt = $reservation_dt;

        return $this;
    }

    public function getNumBrorrow(): ?string
    {
        return $this->numBrorrow;
    }

    public function setNumBrorrow(string $numBrorrow): self
    {
        $this->numBrorrow = $numBrorrow;

        return $this;
    }
}
