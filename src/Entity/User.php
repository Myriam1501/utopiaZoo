<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\HasLifecycleCallbacks()]

#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $first_name = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private ?string $resetToken;

    #[ORM\Column(nullable: false)]
    private ?\DateTimeImmutable $date_inscription = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column(nullable: false)]
    private ?string $password = null;

    #[ORM\Column]
    private ?bool $Check_email = false;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Reservation::class, orphanRemoval: true)]
    private Collection $reservations;


    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
    public function getfirstname(): ?string
    {
        return $this->first_name;
    }

    public function setfirstname(string $firstname): self
    {
        $this->first_name = $firstname;

        return $this;
    }

    public function getname(): ?string
    {
        return $this->name;
    }

    public function setname(string $name): self
    {
        $this->name = $name;

        return $this;
    }
    public function getaddress(): ?string
    {
        return $this->address;
    }

    public function setdddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }
    public function getDateInscription(): ?\DateTimeImmutable
    {
        return $this->date_inscription;
    }

    public function setDateInscription(\DateTimeImmutable $date_inscription): self
    {
        $this->date_inscription = $date_inscription;

        return $this;
    }

    public function getResetToken(): ?string{
        return  $this->resetToken;
    }
    public function setResetToken(?string $resettaken): self{
        $this->resetToken = $resettaken;
        return $this;
    }



    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string|null
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
    #[ORM\PrePersist]
    public function setDate_Inscription():void{
        $this->date_inscription =new \DateTimeImmutable();
    }

    public function isCheckEmail(): ?bool
    {
        return $this->Check_email;
    }

    public function setCheckEmail(bool $Check_email): self
    {
        $this->Check_email = $Check_email;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        // unset the owning side of the relation if necessary
        if ($reservation === null && $this->reservation !== null) {
            $this->reservation->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($reservation !== null && $reservation->getUser() !== $this) {
            $reservation->setUser($this);
        }

        $this->reservation = $reservation;

        return $this;
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
            $reservation->setUser($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getUser() === $this) {
                $reservation->setUser(null);
            }
        }

        return $this;
    }

}

