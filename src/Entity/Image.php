<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
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
    private $chemin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Oeuvres", inversedBy="images")
     */
    private $oeuvre;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Carousel", mappedBy="image")
     */
    private $carousels;

    public function __construct()
    {
        $this->carousels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChemin(): ?string
    {
        return $this->chemin;
    }

    public function setChemin(string $chemin): self
    {
        $this->chemin = $chemin;

        return $this;
    }

    public function getOeuvre(): ?Oeuvres
    {
        return $this->oeuvre;
    }

    public function setOeuvre(?Oeuvres $oeuvre): self
    {
        $this->oeuvre = $oeuvre;

        return $this;
    }

    /**
     * @return Collection|Carousel[]
     */
    public function getCarousels(): Collection
    {
        return $this->carousels;
    }

    public function addCarousel(Carousel $carousel): self
    {
        if (!$this->carousels->contains($carousel)) {
            $this->carousels[] = $carousel;
            $carousel->addImage($this);
        }

        return $this;
    }

    public function removeCarousel(Carousel $carousel): self
    {
        if ($this->carousels->contains($carousel)) {
            $this->carousels->removeElement($carousel);
            $carousel->removeImage($this);
        }

        return $this;
    }
}
