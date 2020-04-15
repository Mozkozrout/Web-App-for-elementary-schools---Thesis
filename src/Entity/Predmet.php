<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PredmetRepository")
 */
class Predmet
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
    private $zkratka;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Skola", inversedBy="predmet")
     */
    private $skola;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cas", mappedBy="predmet")
     */
    private $cas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Znamka", mappedBy="predmet", orphanRemoval=true)
     */
    private $znamka;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\VybranePredmety", mappedBy="predmet")
     */
    private $vybranePredmety;




    public function __construct()
    {
        $this->cas = new ArrayCollection();
        $this->znamka = new ArrayCollection();
        $this->vybranePredmety = new ArrayCollection();
    }

    public function __toString()
    {
        return $this -> nazev;
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

    public function getZkratka(): ?string
    {
        return $this->zkratka;
    }

    public function setZkratka(string $zkratka): self
    {
        $this->zkratka = $zkratka;

        return $this;
    }

    public function getSkola(): ?Skola
    {
        return $this->skola;
    }

    public function setSkola(?Skola $skola): self
    {
        $this->skola = $skola;

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
            $ca->setPredmet($this);
        }

        return $this;
    }

    public function removeCa(Cas $ca): self
    {
        if ($this->cas->contains($ca)) {
            $this->cas->removeElement($ca);
            // set the owning side to null (unless already changed)
            if ($ca->getPredmet() === $this) {
                $ca->setPredmet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Znamka[]
     */
    public function getZnamka(): Collection
    {
        return $this->znamka;
    }

    public function addZnamka(Znamka $znamka): self
    {
        if (!$this->znamka->contains($znamka)) {
            $this->znamka[] = $znamka;
            $znamka->setPredmet($this);
        }

        return $this;
    }

    public function removeZnamka(Znamka $znamka): self
    {
        if ($this->znamka->contains($znamka)) {
            $this->znamka->removeElement($znamka);
            // set the owning side to null (unless already changed)
            if ($znamka->getPredmet() === $this) {
                $znamka->setPredmet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|VybranePredmety[]
     */
    public function getVybranePredmety(): Collection
    {
        return $this->vybranePredmety;
    }

    public function addVybranePredmety(VybranePredmety $vybranePredmety): self
    {
        if (!$this->vybranePredmety->contains($vybranePredmety)) {
            $this->vybranePredmety[] = $vybranePredmety;
            $vybranePredmety->addPredmet($this);
        }

        return $this;
    }

    public function removeVybranePredmety(VybranePredmety $vybranePredmety): self
    {
        if ($this->vybranePredmety->contains($vybranePredmety)) {
            $this->vybranePredmety->removeElement($vybranePredmety);
            $vybranePredmety->removePredmet($this);
        }

        return $this;
    }





}
