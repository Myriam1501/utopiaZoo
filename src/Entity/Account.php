<?php

namespace App\Entity;

use App\Repository\AccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccountRepository::class)]
#[ORM\HasLifecycleCallbacks()]
class Account
{
    #[ORM\Id]
    #[ORM\GeneratedValue]

    #[ORM\Column]
    private ?int $Id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(length: 255)]
    private ?string $FirstName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Address = null;

    #[ORM\Column]
    private ?int $Passeword = null;

    #[ORM\Column(length: 255)]
    private ?string $Email_Login = null;

    #[ORM\Column(nullable: false)]
    private ?\DateTimeImmutable $Date_Inscription = null;

    #[ORM\OneToMany(mappedBy: 'account', targetEntity: Reservation::class)]
    private Collection $reservations;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(?string $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    public function getPasseword(): ?int
    {
        return $this->Passeword;
    }

    public function setPasseword(int $Passeword): self
    {
        $this->Passeword = $Passeword;

        return $this;
    }

    public function getEmailLogin(): ?string
    {
        return $this->Email_Login;
    }

    public function setEmailLogin(string $Email_Login): self
    {
        $this->Email_Login = $Email_Login;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeImmutable
    {
        return $this->Date_Inscription;
    }



    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setAccount($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getAccount() === $this) {
                $reservation->setAccount(null);
            }
        }

        return $this;
    }

}
