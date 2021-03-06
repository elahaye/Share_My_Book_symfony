<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BookRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 * @ApiResource(
 *   normalizationContext={"groups"={"book:read"}},
 *   attributes={"pagination_enabled"=false}
 * )
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"user:read", "booklist:read","book:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read", "booklist:read", "book:read"})
     */
    private $referenceApi;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read", "booklist:read", "book:read"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read", "booklist:read", "book:read"})
     */
    private $author;

    /**
     * @ORM\Column(type="date")
     * @Groups({"user:read", "booklist:read", "book:read"})
     */
    private $publicationDate;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"user:read", "booklist:read", "book:read"})
     */
    private $totalPages;

    /**
     * @ORM\ManyToMany(targetEntity=Booklist::class, mappedBy="books")
     */
    private $booklists;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user:read", "booklist:read", "book:read"})
     */
    private $image;

    public function __construct()
    {
        $this->booklists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReferenceApi(): ?string
    {
        return $this->referenceApi;
    }

    public function setReferenceApi(string $referenceApi): self
    {
        $this->referenceApi = $referenceApi;

        return $this;
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

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(\DateTimeInterface $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getTotalPages(): ?int
    {
        return $this->totalPages;
    }

    public function setTotalPages(int $totalPages): self
    {
        $this->totalPages = $totalPages;

        return $this;
    }

    /**
     * @return Collection|Booklist[]
     */
    public function getBooklists(): Collection
    {
        return $this->booklists;
    }

    public function addBooklist(Booklist $booklist): self
    {
        if (!$this->booklists->contains($booklist)) {
            $this->booklists[] = $booklist;
            $booklist->addBook($this);
        }

        return $this;
    }

    public function removeBooklist(Booklist $booklist): self
    {
        if ($this->booklists->contains($booklist)) {
            $this->booklists->removeElement($booklist);
            $booklist->removeBook($this);
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
