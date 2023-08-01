<?php

namespace App\Entity;

use App\Repository\SessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionRepository::class)]
class Session
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateStart = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateEnd = null;

    #[ORM\Column]
    private ?int $nbrsPlaces = null;

    #[ORM\ManyToMany(targetEntity: Intern::class, inversedBy: 'sessions')]
    private Collection $interns;

    #[ORM\OneToMany(mappedBy: 'session', targetEntity: Planning::class, orphanRemoval: true)]
    private Collection $plannings;

    public function __construct()
    {
        $this->interns = new ArrayCollection();
        $this->plannings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTimeInterface $dateStart): static
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(\DateTimeInterface $dateEnd): static
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getNbrsPlaces(): ?int
    {
        return $this->nbrsPlaces;
    }

    public function setNbrsPlaces(int $nbrsPlaces): static
    {
        $this->nbrsPlaces = $nbrsPlaces;

        return $this;
    }

    /**
     * @return Collection<int, Intern>
     */
    public function getInterns(): Collection
    {
        return $this->interns;
    }

    public function addIntern(Intern $intern): static
    {
        if (!$this->interns->contains($intern)) {
            $this->interns->add($intern);
        }

        return $this;
    }

    public function removeIntern(Intern $intern): static
    {
        $this->interns->removeElement($intern);

        return $this;
    }

    /**
     * @return Collection<int, Planning>
     */
    public function getPlannings(): Collection
    {
        return $this->plannings;
    }

    public function addPlanning(Planning $planning): static
    {
        if (!$this->plannings->contains($planning)) {
            $this->plannings->add($planning);
            $planning->setSession($this);
        }

        return $this;
    }

    public function removePlanning(Planning $planning): static
    {
        if ($this->plannings->removeElement($planning)) {
            // set the owning side to null (unless already changed)
            if ($planning->getSession() === $this) {
                $planning->setSession(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this -> name;
    }


}
