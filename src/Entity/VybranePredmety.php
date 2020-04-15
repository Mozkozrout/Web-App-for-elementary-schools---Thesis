<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VybranePredmetyRepository")
 */
class VybranePredmety
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trida", mappedBy="vybranePredmety")
     */
    private $trida;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Predmet", inversedBy="vybranePredmety")
     */
    private $predmet;

    public function __construct()
    {
        $this->trida = new ArrayCollection();
        $this->predmet = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }



    /**
     * @return Collection|Trida[]
     */
    public function getTrida(): Collection
    {
        return $this->trida;
    }

    public function addTrida(Trida $trida): self
    {
        if (!$this->trida->contains($trida)) {
            $this->trida[] = $trida;
            $trida->setVybranePredmety($this);
        }

        return $this;
    }

    public function removeTrida(Trida $trida): self
    {
        if ($this->trida->contains($trida)) {
            $this->trida->removeElement($trida);
            // set the owning side to null (unless already changed)
            if ($trida->getVybranePredmety() === $this) {
                $trida->setVybranePredmety(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Predmet[]
     */
    public function getPredmet(): Collection
    {
        return $this->predmet;
    }

    public function addPredmet(Predmet $predmet): self
    {
        if (!$this->predmet->contains($predmet)) {
            $this->predmet[] = $predmet;
        }

        return $this;
    }

    public function removePredmet(Predmet $predmet): self
    {
        if ($this->predmet->contains($predmet)) {
            $this->predmet->removeElement($predmet);
        }

        return $this;
    }
}
