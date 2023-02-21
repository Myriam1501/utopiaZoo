<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    #[ORM\Column]
    private ?int $qte_reduce = null;

    #[ORM\Column]
    private ?int $qte_normal = null;

    #[ORM\ManyToMany(targetEntity: Program::class, inversedBy: 'reservations')]
    private Collection $programs;

    public function __construct()
    {
        $this->programs = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getQteReduce(): ?int
    {
        return $this->qte_reduce;
    }

    public function setQteReduce(int $qte_reduce): self
    {
        $this->qte_reduce = $qte_reduce;

        return $this;
    }

    public function getQteNormal(): ?int
    {
        return $this->qte_normal;
    }

    public function setQteNormal(int $qte_normal): self
    {
        $this->qte_normal = $qte_normal;

        return $this;
    }

    /**
     * @return Collection<int, Program>
     */
    public function getPrograms(): Collection
    {
        return $this->programs;
    }

    public function addProgram(Program $program): self
    {
        if (!$this->programs->contains($program)) {
            $this->programs->add($program);
        }

        return $this;
    }

    public function removeProgram(Program $program): self
    {
        $this->programs->removeElement($program);

        return $this;
    }


}
