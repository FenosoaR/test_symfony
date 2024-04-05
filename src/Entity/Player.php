<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\Column(length: 255)]
    private ?string $nationalite = null;

    #[ORM\Column]
    private ?int $nombreBut = null;

    #[ORM\ManyToOne(inversedBy: 'players')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Club $club = null;

    #[ORM\ManyToOne(inversedBy: 'players')]
    #[ORM\JoinColumn(nullable: false)]
    private ?National $national = null;

    #[ORM\Column(length: 255)]
    private ?string $parcours = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): static
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): static
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getNombreBut(): ?int
    {
        return $this->nombreBut;
    }

    public function setNombreBut(int $nombreBut): static
    {
        $this->nombreBut = $nombreBut;

        return $this;
    }

    public function getClub(): ?Club
    {
        return $this->club;
    }

    public function setClub(?Club $club): static
    {
        $this->club = $club;

        return $this;
    }

    public function getNational(): ?National
    {
        return $this->national;
    }

    public function setNational(?National $national): static
    {
        $this->national = $national;

        return $this;
    }

    public function getParcours(): ?string
    {
        return $this->parcours;
    }

    public function setParcours(string $parcours): static
    {
        $this->parcours = $parcours;

        return $this;
    }
}
