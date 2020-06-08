<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtisteRepository")
 */
class Artiste
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     */
    private $date_naissance;

    /**
     * @ORM\Column(type="text")
     */
    private $biographie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Experience", mappedBy="artiste")
     */
    private $experiences;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Recompense", mappedBy="artiste")
     */
    private $recompenses;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Oeuvres", mappedBy="artiste")
     */
    private $oeuvres;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Exposition", mappedBy="artiste")
     */
    private $expositions;

    public function __construct()
    {
        $this->experiences = new ArrayCollection();
        $this->recompenses = new ArrayCollection();
        $this->oeuvres = new ArrayCollection();
        $this->expositions = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getBiographie(): ?string
    {
        return $this->biographie;
    }

    public function setBiographie(string $biographie): self
    {
        $this->biographie = $biographie;

        return $this;
    }

    /**
     * @return Collection|Experience[]
     */
    public function getExperiences(): Collection
    {
        return $this->experiences;
    }

    public function addExperience(Experience $experience): self
    {
        if (!$this->experiences->contains($experience)) {
            $this->experiences[] = $experience;
            $experience->setArtiste($this);
        }

        return $this;
    }

    public function removeExperience(Experience $experience): self
    {
        if ($this->experiences->contains($experience)) {
            $this->experiences->removeElement($experience);
            // set the owning side to null (unless already changed)
            if ($experience->getArtiste() === $this) {
                $experience->setArtiste(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Recompense[]
     */
    public function getRecompenses(): Collection
    {
        return $this->recompenses;
    }

    public function addRecompense(Recompense $recompense): self
    {
        if (!$this->recompenses->contains($recompense)) {
            $this->recompenses[] = $recompense;
            $recompense->setArtiste($this);
        }

        return $this;
    }

    public function removeRecompense(Recompense $recompense): self
    {
        if ($this->recompenses->contains($recompense)) {
            $this->recompenses->removeElement($recompense);
            // set the owning side to null (unless already changed)
            if ($recompense->getArtiste() === $this) {
                $recompense->setArtiste(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Oeuvres[]
     */
    public function getOeuvres(): Collection
    {
        return $this->oeuvres;
    }

    public function addOeuvre(Oeuvres $oeuvre): self
    {
        if (!$this->oeuvres->contains($oeuvre)) {
            $this->oeuvres[] = $oeuvre;
            $oeuvre->setArtiste($this);
        }

        return $this;
    }

    public function removeOeuvre(Oeuvres $oeuvre): self
    {
        if ($this->oeuvres->contains($oeuvre)) {
            $this->oeuvres->removeElement($oeuvre);
            // set the owning side to null (unless already changed)
            if ($oeuvre->getArtiste() === $this) {
                $oeuvre->setArtiste(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Exposition[]
     */
    public function getExpositions(): Collection
    {
        return $this->expositions;
    }

    public function addExposition(Exposition $exposition): self
    {
        if (!$this->expositions->contains($exposition)) {
            $this->expositions[] = $exposition;
            $exposition->setArtiste($this);
        }

        return $this;
    }

    public function removeExposition(Exposition $exposition): self
    {
        if ($this->expositions->contains($exposition)) {
            $this->expositions->removeElement($exposition);
            // set the owning side to null (unless already changed)
            if ($exposition->getArtiste() === $this) {
                $exposition->setArtiste(null);
            }
        }

        return $this;
    }
}
