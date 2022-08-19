<?php

namespace App\Entity;

use App\Repository\ParkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParkRepository::class)]
class Park
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $park_code;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $state_code;

    #[ORM\Column(type: 'date', nullable: true)]
    private $foundation_date;

    #[ORM\ManyToMany(targetEntity: Trip::class, inversedBy: 'parks')]
    private $trip;

    public function __construct()
    {
        $this->trip = new ArrayCollection();
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

    public function getParkCode(): ?string
    {
        return $this->park_code;
    }

    public function setParkCode(?string $park_code): self
    {
        $this->park_code = $park_code;

        return $this;
    }

    public function getStateCode(): ?string
    {
        return $this->state_code;
    }

    public function setStateCode(?string $state_code): self
    {
        $this->state_code = $state_code;

        return $this;
    }

    public function getFoundationDate(): ?\DateTimeInterface
    {
        return $this->foundation_date;
    }

    public function setFoundationDate(?\DateTimeInterface $foundation_date): self
    {
        $this->foundation_date = $foundation_date;

        return $this;
    }

    /**
     * @return Collection<int, Trip>
     */
    public function getTrip(): Collection
    {
        return $this->trip;
    }

    public function addTrip(Trip $trip): self
    {
        if (!$this->trip->contains($trip)) {
            $this->trip[] = $trip;
        }

        return $this;
    }

    public function removeTrip(Trip $trip): self
    {
        $this->trip->removeElement($trip);

        return $this;
    }
}
