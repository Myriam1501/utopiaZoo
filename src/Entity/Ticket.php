<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $qte_normal = null;

    #[ORM\Column(nullable: true)]
    private ?int $qte_reduce = null;

    #[ORM\ManyToOne(inversedBy: 'tickets')]
    private ?Program $program = null;

    #[ORM\ManyToOne(inversedBy: 'tickets')]
    private ?Reservation $reservation = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getQteReduce(): ?int
    {
        return $this->qte_reduce;
    }

    public function setQteReduce(?int $qte_reduce): self
    {
        $this->qte_reduce = $qte_reduce;

        return $this;
    }

    public function getProgram(): ?Program
    {
        return $this->program;
    }

    public function setProgram(?Program $program): self
    {
        $this->program = $program;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }
}
