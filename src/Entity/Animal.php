<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\VichUploaderBundle;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnimalRepository")
 */


#[ORM\Entity(repositoryClass: AnimalRepository::class)]
#[Vich\Uploadable]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sound = null;

    #[ORM\Column(length: 2000, nullable: true)]
    private ?string $picture = null;

    /**
     * @var File
     */
    #[Vich\UploadableField(mapping: 'animal_image', fileNameProperty: 'picture')]
    protected $picturefile;

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

    public function getSound(): ?string
    {
        return $this->sound;
    }

    public function setSound(?string $sound): self
    {
        $this->sound = $sound;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getPictureFile(): ?File
    {
        return $this->picturefile;
    }

    /**
     * @param File|null $pictureFile
     */
    public function setPicturefile(?File $picturefile = null)
    {
        $this->picturefile = $picturefile;

        /**if(null != $pictureFile) {
            $this->updated = new \Datetime();
        }**/
    }
}
