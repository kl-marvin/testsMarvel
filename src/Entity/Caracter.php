<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CaracterRepository")
 * @Vich\Uploadable()
 * @UniqueEntity("name")
 */
class Caracter
{
    CONST SEX = [
        1 => 'Homme',
        2 => 'Femme'
    ];

    /**
     * @ORM\ManyToMany(targetEntity="Power", cascade={"persist"})
     */
    private $powers;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $filename;


    /**
     * @var File
     * @Vich\UploadableField(mapping="caracter_image", fileNameProperty="filename" )
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=4, max="230")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(min=1, max=99)
     */
    private $age;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sex;

    /**
     * @ORM\Column(type="datetime")
     *
     */
    private $updated_at;

    public function __construct()
    {
        $this->powers = new ArrayCollection();
    }


    public function getPowers()
    {
      return $this->powers;
    }

    public function addPower(Power $power)
    {
        $this->powers[] = $power;
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

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getSex(): ?bool
    {
        return $this->sex;
    }

    public function setSex(bool $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * @param null|string $filename
     * @return Caracter
     */
    public function setFilename(?string $filename): Caracter
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @param null|File $imageFile
     * @return Caracter
     */
    public function setImageFile(?File $imageFile): Caracter
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile){
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }

    /**
     * @return null|string
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @return null|File
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }


}
