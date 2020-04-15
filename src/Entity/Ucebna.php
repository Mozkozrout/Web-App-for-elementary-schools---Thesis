<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UcebnaRepository")
 */
class Ucebna
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
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $patro;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Skola", inversedBy="ucebna")
     */
    private $skola;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cas", mappedBy="ucebna")
     */
    private $cas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ucitele", mappedBy="ucebna")
     */
    private $ucitele;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Trida", mappedBy="ucebna", cascade={"persist", "remove"})
     */
    private $trida;



    public function __construct()
    {
        $this->cas = new ArrayCollection();
        $this->ucitele = new ArrayCollection();
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

    public function getPatro(): ?int
    {
        return $this->patro;
    }

    public function setPatro(?int $patro): self
    {
        $this->patro = $patro;

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
            $ca->setUcebna($this);
        }

        return $this;
    }

    public function removeCa(Cas $ca): self
    {
        if ($this->cas->contains($ca)) {
            $this->cas->removeElement($ca);
            // set the owning side to null (unless already changed)
            if ($ca->getUcebna() === $this) {
                $ca->setUcebna(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ucitele[]
     */
    public function getUcitele(): Collection
    {
        return $this->ucitele;
    }

    public function addUcitele(Ucitele $ucitele): self
    {
        if (!$this->ucitele->contains($ucitele)) {
            $this->ucitele[] = $ucitele;
            $ucitele->setUcebna($this);
        }

        return $this;
    }

    public function removeUcitele(Ucitele $ucitele): self
    {
        if ($this->ucitele->contains($ucitele)) {
            $this->ucitele->removeElement($ucitele);
            // set the owning side to null (unless already changed)
            if ($ucitele->getUcebna() === $this) {
                $ucitele->setUcebna(null);
            }
        }

        return $this;
    }

    public function getTrida(): ?Trida
    {
        return $this->trida;
    }

    public function setTrida(?Trida $trida): self
    {
        $this->trida = $trida;

        // set (or unset) the owning side of the relation if necessary
        $newUcebna = null === $trida ? null : $this;
        if ($trida->getUcebna() !== $newUcebna) {
            $trida->setUcebna($newUcebna);
        }

        return $this;
    }

}
