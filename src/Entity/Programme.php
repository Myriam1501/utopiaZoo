<?php

namespace App\Entity;

use App\Repository\ProgrammeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ProgrammeRepository::class)]
#[UniqueEntity('titre_programme')]
class Programme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_programme = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_deb = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description_programme = null;

    #[ORM\Column(nullable: true)]
    private ?int $age_minim_prog = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pictureDecoPath = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $timer_programmer = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $deletedAt = null;

    public function __construct()
    {

        $this->createdAt= new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreProgramme(): ?string
    {
        return $this->titre_programme;
    }

    public function setTitreProgramme(string $titre_programme): self
    {
        $this->titre_programme = $titre_programme;

        return $this;
    }

    public function getDateDeb(): ?\DateTimeInterface
    {
        return $this->date_deb;
    }

    public function setDateDeb(?\DateTimeInterface $date_deb): self
    {
        $this->date_deb = $date_deb;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(?\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getDescriptionProgramme(): ?string
    {
        return $this->description_programme;
    }

    public function setDescriptionProgramme(?string $description_programme): self
    {
        $this->description_programme = $description_programme;

        return $this;
    }

    public function getAgeMinimProg(): ?int
    {
        return $this->age_minim_prog;
    }

    public function setAgeMinimProg(?int $age_minim_prog): self
    {
        $this->age_minim_prog = $age_minim_prog;

        return $this;
    }

    public function getPictureDecoPath(): ?string
    {
        return $this->pictureDecoPath;
    }

    public function setPictureDecoPath(?string $pictureDecoPath): self
    {
        $this->pictureDecoPath = $pictureDecoPath;

        return $this;
    }

    public function getTimerProgrammer(): ?string
    {
        return $this->timer_programmer;
    }

    public function setTimerProgrammer(string $timer_programmer): self
    {
        $this->timer_programmer = $timer_programmer;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeImmutable $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }
}
