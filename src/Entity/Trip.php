<?php

namespace App\Entity;

use App\Repository\TripRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TripRepository::class)]
class Trip
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'date', nullable: true)]
    private $startDate;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $duration;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $nbTraveller;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $budget;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'trips')]
    private $traveller;

    #[ORM\ManyToMany(targetEntity: Park::class, mappedBy: 'trip')]
    private $parks;

    public function __construct()
    {
        $this->traveller = new ArrayCollection();
        $this->parks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getNbTraveller(): ?int
    {
        return $this->nbTraveller;
    }

    public function setNbTraveller(?int $nbTraveller): self
    {
        $this->nbTraveller = $nbTraveller;

        return $this;
    }

    public function getBudget(): ?int
    {
        return $this->budget;
    }

    public function setBudget(?int $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getTraveller(): Collection
    {
        return $this->traveller;
    }

    public function addTraveller(User $traveller): self
    {
        if (!$this->traveller->contains($traveller)) {
            $this->traveller[] = $traveller;
        }

        return $this;
    }

    public function removeTraveller(User $traveller): self
    {
        $this->traveller->removeElement($traveller);

        return $this;
    }

    /**
     * @return Collection<int, Park>
     */
    public function getParks(): Collection
    {
        return $this->parks;
    }

    public function addPark(Park $park): self
    {
        if (!$this->parks->contains($park)) {
            $this->parks[] = $park;
            $park->addTrip($this);
        }

        return $this;
    }

    public function removePark(Park $park): self
    {
        if ($this->parks->removeElement($park)) {
            $park->removeTrip($this);
        }

        return $this;
    }
}
