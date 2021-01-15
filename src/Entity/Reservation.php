<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity=Utilisateur::class, inversedBy="reservations")
     */
    private $nom_client;

    public function __construct()
    {
        $this->nom_client = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function __toString()
    {
        $date = $this->date;
        return $date->format('Y-m-d H:i:s');
    }

    /**
     * @return Collection|Utilisateur[]
     */
    public function getNomClient(): Collection
    {
        return $this->nom_client;
    }

    public function addNomClient(Utilisateur $nomClient): self
    {
        if (!$this->nom_client->contains($nomClient)) {
            $this->nom_client[] = $nomClient;
        }

        return $this;
    }

    public function removeNomClient(Utilisateur $nomClient): self
    {
        $this->nom_client->removeElement($nomClient);

        return $this;
    }
}
