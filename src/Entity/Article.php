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
     * @ORM\ManyToMany(targetEntity=Utilisateur::class, mappedBy="articles")
     */
    private $utilisateurs;

    /**
     * @ORM\ManyToOne(targetEntity=Stock::class, inversedBy="articles")
     */
    private $stocks;

    /**
     * @ORM\ManyToOne(targetEntity=Magasin::class, inversedBy="articles")
     */
    private $magasins;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
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

    public function __toString()
    {
        return $this->nom;
    }

    /**
     * @return Collection|Utilisateur[]
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Utilisateur $utilisateur): self
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs[] = $utilisateur;
            $utilisateur->addArticle($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): self
    {
        if ($this->utilisateurs->removeElement($utilisateur)) {
            $utilisateur->removeArticle($this);
        }

        return $this;
    }

    public function getStocks(): ?Stock
    {
        return $this->stocks;
    }

    public function setStocks(?Stock $stocks): self
    {
        $this->stocks = $stocks;

        return $this;
    }

    public function getMagasins(): ?Magasin
    {
        return $this->magasins;
    }

    public function setMagasins(?Magasin $magasins): self
    {
        $this->magasins = $magasins;

        return $this;
    }
}
