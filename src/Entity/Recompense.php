<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecompenseRepository")
 */
class Recompense
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_obtention;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lieu;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Artiste", inversedBy="recompenses")
     */
    private $artiste;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateObtention(): ?\DateTimeInterface
    {
        return $this->date_obtention;
    }

    public function setDateObtention(?\DateTimeInterface $date_obtention): self
    {
        $this->date_obtention = $date_obtention;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(?string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getArtiste(): ?Artiste
    {
        return $this->artiste;
    }

    public function setArtiste(?Artiste $artiste): self
    {
        $this->artiste = $artiste;

        return $this;
    }
}
