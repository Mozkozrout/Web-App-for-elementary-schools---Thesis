<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DobaRepository")
 */
class Doba
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $doba;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cas", mappedBy="doba")
     */
    private $cas;

    public function __construct()
    {
        $this->cas = new ArrayCollection();
    }

    public function __toString()
    {
        return $this -> doba -> format("H:i");
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDoba(): ?\DateTimeInterface
    {
        return $this->doba;
    }

    public function setDoba(\DateTimeInterface $doba): self
    {
        $this->doba = $doba;

        return $this;
    }

    /**
     * @return Collection|Cas[]
     */
    public function getCas(): Collection
    {
        return $this->cas;
    }

    public function addCa(Cas $ca): self
    {
        if (!$this->cas->contains($ca)) {
            $this->cas[] = $ca;
            $ca->setDoba($this);
        }

        return $this;
    }

    public function removeCa(Cas $ca): self
    {
        if ($this->cas->contains($ca)) {
            $this->cas->removeElement($ca);
            // set the owning side to null (unless already changed)
            if ($ca->getDoba() === $this) {
                $ca->setDoba(null);
            }
        }

        return $this;
    }
}
