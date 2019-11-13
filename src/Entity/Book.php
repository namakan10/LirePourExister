<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 * @Vich\Uploadable
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150, unique=true)
     */
    private $title;


    /**
     * @ORM\Column(type="date")
     */
    private $published_dt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $language;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbre_copies;

    /**
     * @ORM\ManyToMany(targetEntity="Theme", inversedBy="books")
     */
    private $theme;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="books_cover", fileNameProperty="image")
     * @var File
     */
    private $imageFile;



    /**
     * @ORM\Column(type="text")
     */
    private $descritpion;


    /**
     * @ORM\Column(type="integer")
     */
    private $nbrePage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $IsbnIssn;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Availability;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Borrow", mappedBy="book")
     */
    private $borrows;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Author", mappedBy="book")
     */
    private $authors;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Editor", inversedBy="book")
     * @ORM\JoinColumn(nullable=false)
     */
    private $editor;



    public function __construct()
    {
        $this->theme = new ArrayCollection();
        $this->updatedAt = new \DateTime();
        $this->borrows = new ArrayCollection();
        $this->authors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }


    public function getPublishedDt(): ?\DateTimeInterface
    {
        return $this->published_dt;
    }

    public function setPublishedDt(\DateTimeInterface $published_dt): self
    {
        $this->published_dt = $published_dt;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }



    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }


    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }


    public function getDescritpion(): ?string
    {
        return $this->descritpion;
    }

    public function setDescritpion(string $descritpion): self
    {
        $this->descritpion = $descritpion;

        return $this;
    }

    /**
     * @return Collection|Theme[]
     */
    public function getTheme(): Collection
    {
        return $this->theme;
    }

    public function addTheme(Theme $theme): self
    {
        if (!$this->theme->contains($theme)) {
            $this->theme[] = $theme;
        }

        return $this;
    }

    public function removeCategory(Theme $theme): self
    {
        if ($this->theme->contains($theme)) {
            $this->theme->removeElement($theme);
        }

        return $this;
    }

    /**
     * @return Collection|Borrow[]
     */
    public function getBorrows(): Collection
    {
        return $this->borrows;
    }

    public function addBorrow(Borrow $borrow): self
    {
        if (!$this->borrows->contains($borrow)) {
            $this->borrows[] = $borrow;
            $borrow->setBook($this);
        }

        return $this;
    }

    public function removeBorrow(Borrow $borrow): self
    {
        if ($this->borrows->contains($borrow)) {
            $this->borrows->removeElement($borrow);
            // set the owning side to null (unless already changed)
            if ($borrow->getBook() === $this) {
                $borrow->setBook(null);
            }
        }

        return $this;
    }


    public function getIsbnIssn(): ?string
    {
        return $this->IsbnIssn;
    }

    public function setIsbnIssn(string $IsbnIssn): self
    {
        $this->IsbnIssn = $IsbnIssn;

        return $this;
    }

    public function getAvailability(): ?string
    {
        return $this->Availability;
    }

    public function setAvailability(string $Availability): self
    {
        $this->Availability = $Availability;

        return $this;
    }

    public function getNbreCopies(): ?int
    {
        return $this->nbre_copies;
    }

    public function setNbreCopies(int $nbre_copies): self
    {
        $this->nbre_copies = $nbre_copies;

        return $this;
    }

    public function getNbrePage(): ?int
    {
        return $this->nbrePage;
    }

    public function setNbrePage(int $nbrePage): self
    {
        $this->nbrePage = $nbrePage;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection|Author[]
     */
    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    public function addAuthor(Author $author): self
    {
        if (!$this->authors->contains($author)) {
            $this->authors[] = $author;
            $author->addBook($this);
        }

        return $this;
    }

    public function removeAuthor(Author $author): self
    {
        if ($this->authors->contains($author)) {
            $this->authors->removeElement($author);
            $author->removeBook($this);
        }

        return $this;
    }

    public function getEditor(): ?Editor
    {
        return $this->editor;
    }

    public function setEditor(?Editor $editor): self
    {
        $this->editor = $editor;

        return $this;
    }




}
