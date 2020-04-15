<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DenRepository")
 */
class Den
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $den;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cas", mappedBy="den")
     */
    private $cas;

    public function __construct()
    {
        $this->cas = new ArrayCollection();
    }

    public function __toString()
    {
        return $this -> den;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDen(): ?string
    {
        return $this->den;
    }

    public function setDen(string $den): self
    {
        $this->den = $den;

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
            $ca->setDen($this);
        }

        return $this;
    }

    public function removeCa(Cas $ca): self
    {
        if ($this->cas->contains($ca)) {
            $this->cas->removeElement($ca);
            // set the owning side to null (unless already changed)
            if ($ca->getDen() === $this) {
                $ca->setDen(null);
            }
        }

        return $this;
    }
}
