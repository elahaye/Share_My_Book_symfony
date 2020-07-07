<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 * @ApiResource(
 *  collectionOperations={"GET"},
 *  itemOperations={"GET"}
 * )
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"booklist:read", "user:read"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Booklist::class, mappedBy="category")
     */
    private $booklists;

    public function __construct()
    {
        $this->booklists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $booklist->setCategory($this);
        }

        return $this;
    }

    public function removeBooklist(Booklist $booklist): self
    {
        if ($this->booklists->contains($booklist)) {
            $this->booklists->removeElement($booklist);
            // set the owning side to null (unless already changed)
            if ($booklist->getCategory() === $this) {
                $booklist->setCategory(null);
            }
        }

        return $this;
    }
}
