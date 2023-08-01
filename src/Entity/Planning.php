<?php

namespace App\Entity;

use App\Repository\PlanningRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanningRepository::class)]
class Planning
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nbrsOfDays = null;

    #[ORM\ManyToOne(inversedBy: 'plannings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Session $session = null;

    #[ORM\ManyToOne(inversedBy: 'plannings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Module $module = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrsOfDays(): ?int
    {
        return $this->nbrsOfDays;
    }

    public function setNbrsOfDays(int $nbrsOfDays): static
    {
        $this->nbrsOfDays = $nbrsOfDays;

        return $this;
    }

    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function setSession(?Session $session): static
    {
        $this->session = $session;

        return $this;
    }

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(?Module $module): static
    {
        $this->module = $module;

        return $this;
    }

}
