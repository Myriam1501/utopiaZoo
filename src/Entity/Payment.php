<?php

namespace App\Entity;

use App\Repository\PaymentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentRepository::class)]
class Payment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $Bank_number = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date_expires = null;

    #[ORM\Column]
    private ?int $Security_code = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Payment_date = null;

    #[ORM\OneToOne(mappedBy: 'payements', cascade: ['persist', 'remove'])]
    private ?Reservation $reservation = null;



    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBankNumber(): ?int
    {
        return $this->Bank_number;
    }

    public function setBankNumber(int $Bank_number): self
    {
        $this->Bank_number = $Bank_number;

        return $this;
    }

    public function getDateExpires(): ?\DateTimeInterface
    {
        return $this->Date_expires;
    }

    public function setDateExpires(\DateTimeInterface $Date_expires): self
    {
        $this->Date_expires = $Date_expires;

        return $this;
    }

    public function getSecurityCode(): ?int
    {
        return $this->Security_code;
    }

    public function setSecurityCode(int $Security_code): self
    {
        $this->Security_code = $Security_code;

        return $this;
    }

    public function getPaymentDate(): ?\DateTimeInterface
    {
        return $this->Payment_date;
    }

    public function setPaymentDate(\DateTimeInterface $Payment_date): self
    {
        $this->Payment_date = $Payment_date;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(Reservation $reservation): self
    {
        // set the owning side of the relation if necessary
        if ($reservation->getPayements() !== $this) {
            $reservation->setPayements($this);
        }

        $this->reservation = $reservation;

        return $this;
    }



}
