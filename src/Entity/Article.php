<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\ManyToMany(targetEntity=Magasin::class, inversedBy="articles")
     */
    private $magasin;

    public function __construct()
    {
        $this->magasin = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * @return Collection|Magasin[]
     */
    public function getMagasin(): Collection
    {
        return $this->magasin;
    }

    public function addMagasin(Magasin $magasin): self
    {
        if (!$this->magasin->contains($magasin)) {
            $this->magasin[] = $magasin;
        }

        return $this;
    }

    public function removeMagasin(Magasin $magasin): self
    {
        $this->magasin->removeElement($magasin);

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }
}
