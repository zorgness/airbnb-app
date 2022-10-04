<?php

namespace App\Entity;

use App\Repository\FlatOptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FlatOptionRepository::class)]
class FlatOption
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column (options: ['default' => false])]
    private ?bool $wifi = null;

    #[ORM\Column (options: ['default' => false])]
    private ?bool $parking = null;

    #[ORM\Column (options: ['default' => false])]
    private ?bool $workingPlace = null;

    #[ORM\Column (options: ['default' => false])]
    private ?bool $animal = null;

    #[ORM\Column (options: ['default' => false])]
    private ?bool $kitchen = null;

    #[ORM\Column (options: ['default' => false])]
    private ?bool $tv = null;

    #[ORM\Column (options: ['default' => false])]
    private ?bool $aircon = null;

    #[ORM\OneToOne(inversedBy: 'flatOption', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Flat $flat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isWifi(): ?bool
    {
        return $this->wifi;
    }

    public function setWifi(bool $wifi): self
    {
        $this->wifi = $wifi;

        return $this;
    }

    public function isParking(): ?bool
    {
        return $this->parking;
    }

    public function setParking(bool $parking): self
    {
        $this->parking = $parking;

        return $this;
    }

    public function isWorkingPlace(): ?bool
    {
        return $this->workingPlace;
    }

    public function setWorkingPlace(bool $workingPlace): self
    {
        $this->workingPlace = $workingPlace;

        return $this;
    }

    public function isAnimal(): ?bool
    {
        return $this->animal;
    }

    public function setAnimal(bool $animal): self
    {
        $this->animal = $animal;

        return $this;
    }

    public function isKitchen(): ?bool
    {
        return $this->kitchen;
    }

    public function setKitchen(bool $kitchen): self
    {
        $this->kitchen = $kitchen;

        return $this;
    }

    public function isTv(): ?bool
    {
        return $this->tv;
    }

    public function setTv(bool $tv): self
    {
        $this->tv = $tv;

        return $this;
    }

    public function isAircon(): ?bool
    {
        return $this->aircon;
    }

    public function setAircon(bool $aircon): self
    {
        $this->aircon = $aircon;

        return $this;
    }

    public function getFlat(): ?Flat
    {
        return $this->flat;
    }

    public function setFlat(Flat $flat): self
    {
        $this->flat = $flat;

        return $this;
    }
}
