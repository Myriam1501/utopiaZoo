<?php

namespace App\Entity;

use App\Repository\AnimaleGameRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimaleGameRepository::class)]
class AnimaleGame
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $img1 = null;

    #[ORM\Column(length: 50)]
    private ?string $img2 = null;

    #[ORM\Column(length: 50)]
    private ?string $img3 = null;

    #[ORM\Column(length: 50)]
    private ?string $img4 = null;

    #[ORM\Column(length: 50)]
    private ?string $img5 = null;

    #[ORM\Column(length: 50)]
    private ?string $img6 = null;

    #[ORM\Column(length: 50)]
    private ?string $img7 = null;

    #[ORM\Column(length: 50)]
    private ?string $img8 = null;

    #[ORM\Column(length: 50)]
    private ?string $img9 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImg1(): ?string
    {
        return $this->img1;
    }

    public function setImg1(string $img1): self
    {
        $this->img1 = $img1;

        return $this;
    }

    public function getImg2(): ?string
    {
        return $this->img2;
    }

    public function setImg2(string $img2): self
    {
        $this->img2 = $img2;

        return $this;
    }

    public function getImg3(): ?string
    {
        return $this->img3;
    }

    public function setImg3(string $img3): self
    {
        $this->img3 = $img3;

        return $this;
    }

    public function getImg4(): ?string
    {
        return $this->img4;
    }

    public function setImg4(string $img4): self
    {
        $this->img4 = $img4;

        return $this;
    }

    public function getImg5(): ?string
    {
        return $this->img5;
    }

    public function setImg5(string $img5): self
    {
        $this->img5 = $img5;

        return $this;
    }

    public function getImg6(): ?string
    {
        return $this->img6;
    }

    public function setImg6(string $img6): self
    {
        $this->img6 = $img6;

        return $this;
    }

    public function getImg7(): ?string
    {
        return $this->img7;
    }

    public function setImg7(string $img7): self
    {
        $this->img7 = $img7;

        return $this;
    }

    public function getImg8(): ?string
    {
        return $this->img8;
    }

    public function setImg8(string $img8): self
    {
        $this->img8 = $img8;

        return $this;
    }

    public function getImg9(): ?string
    {
        return $this->img9;
    }

    public function setImg9(string $img9): self
    {
        $this->img9 = $img9;

        return $this;
    }
}
