<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SkolaRepository")
 */
class Skola
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nazev;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $stat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mesto;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ulice;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $cisPop;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Predmet", mappedBy="skola")
     */
    private $predmet;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ucitele", mappedBy="skola")
     */
    private $ucitel;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trida", mappedBy="skola")
     */
    private $trida;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Zak", mappedBy="skola")
     */
    private $zak;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ucebna", mappedBy="skola")
     */
    private $ucebna;

    public function __construct()
    {
        $this->predmet = new ArrayCollection();
        $this->ucitel = new ArrayCollection();
        $this->trida = new ArrayCollection();
        $this->zak = new ArrayCollection();
        $this->ucebna = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazev(): ?string
    {
        return $this->nazev;
    }

    public function setNazev(string $nazev): self
    {
        $this->nazev = $nazev;

        return $this;
    }

    public function getStat(): ?string
    {
        return $this->stat;
    }

    public function setStat(string $stat): self
    {
        $this->stat = $stat;

        return $this;
    }

    public function getMesto(): ?string
    {
        return $this->mesto;
    }

    public function setMesto(string $mesto): self
    {
        $this->mesto = $mesto;

        return $this;
    }

    public function getUlice(): ?string
    {
        return $this->ulice;
    }

    public function setUlice(string $ulice): self
    {
        $this->ulice = $ulice;

        return $this;
    }

    public function getCisPop(): ?string
    {
        return $this->cisPop;
    }

    public function setCisPop(string $cisPop): self
    {
        $this->cisPop = $cisPop;

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
            $predmet->setSkola($this);
        }

        return $this;
    }

    public function removePredmet(Predmet $predmet): self
    {
        if ($this->predmet->contains($predmet)) {
            $this->predmet->removeElement($predmet);
            // set the owning side to null (unless already changed)
            if ($predmet->getSkola() === $this) {
                $predmet->setSkola(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ucitel[]
     */
    public function getUcitel(): Collection
    {
        return $this->ucitel;
    }

    public function __toString()
    {
        return $this -> nazev;
    }

    public function addUcitel(Ucitele $ucitel): self
    {
        if (!$this->ucitel->contains($ucitel)) {
            $this->ucitel[] = $ucitel;
            $ucitel->setSkola($this);
        }

        return $this;
    }

    public function removeUcitel(Ucitele $ucitel): self
    {
        if ($this->ucitel->contains($ucitel)) {
            $this->ucitel->removeElement($ucitel);
            // set the owning side to null (unless already changed)
            if ($ucitel->getSkola() === $this) {
                $ucitel->setSkola(null);
            }
        }

        return $this;
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
            $trida->setSkola($this);
        }

        return $this;
    }

    public function removeTrida(Trida $trida): self
    {
        if ($this->trida->contains($trida)) {
            $this->trida->removeElement($trida);
            // set the owning side to null (unless already changed)
            if ($trida->getSkola() === $this) {
                $trida->setSkola(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Zak[]
     */
    public function getZak(): Collection
    {
        return $this->zak;
    }

    public function addZak(Zak $zak): self
    {
        if (!$this->zak->contains($zak)) {
            $this->zak[] = $zak;
            $zak->setSkola($this);
        }

        return $this;
    }

    public function removeZak(Zak $zak): self
    {
        if ($this->zak->contains($zak)) {
            $this->zak->removeElement($zak);
            // set the owning side to null (unless already changed)
            if ($zak->getSkola() === $this) {
                $zak->setSkola(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ucebna[]
     */
    public function getUcebna(): Collection
    {
        return $this->ucebna;
    }

    public function addUcebna(Ucebna $ucebna): self
    {
        if (!$this->ucebna->contains($ucebna)) {
            $this->ucebna[] = $ucebna;
            $ucebna->setSkola($this);
        }

        return $this;
    }

    public function removeUcebna(Ucebna $ucebna): self
    {
        if ($this->ucebna->contains($ucebna)) {
            $this->ucebna->removeElement($ucebna);
            // set the owning side to null (unless already changed)
            if ($ucebna->getSkola() === $this) {
                $ucebna->setSkola(null);
            }
        }

        return $this;
    }
}
