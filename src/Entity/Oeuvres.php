<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;

use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\OeuvresRepository")
 * @Vich\Uploadable()
 */
class Oeuvres
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    // /**
    //  * @var string|null
    //  *@ORM\Column(type="string", length=255)
    //  */
    // private $filename;

    // /**
    //  * @var File|null;
    //  * @Vich\UploadableField(mapping="oeuvre_image", fileNameProperty="filename")
    //  */
    // private $imageFile;

    /**
    * @ORM\Column(type="string", length=80)
    * @Assert\Length(
    *      min = 2,
    *      max = 50,
    *      minMessage = "Le nom ne peut pas avoir moins de 4 lettres",
    *      maxMessage = "Le nom ne peut pas avoir plus de 80 lettres",
    *      allowEmptyString = false
    * )
    */
    private $nom;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_creation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categories", inversedBy="oeuvres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="oeuvre")
     */
    private $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(?\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setOeuvre($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getOeuvre() === $this) {
                $image->setOeuvre(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }

    // /**
    //  * @return null|string
    //  */
    // public function getFilename(): ?string
    // {
    //     return $this->filename;
    // }

    // /**
    //  * @param null|string $filename
    //  * @return Oeuvres
    //  */
    // public function setFilename(?string $filename): Oeuvres
    // {
    //     $this->filename = $filename;
    //     return $this;
    // }

    // /**
    //  * @return null|File
    //  */
    // public function getImageFile(): ?File
    // {
    //     return $this->imageFile;
    // }

    // /**
    //  * @param null|File $imageFile
    //  * @return Oeuvres
    //  */
    // public function setImageFile(?File $imageFile): Oeuvres
    // {
    //     $this->imageFile = $imageFile;
    //     return $this;
    // }
}
