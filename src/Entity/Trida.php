<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TridaRepository")
 */
class Trida
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
     * @ORM\OneToOne(targetEntity="App\Entity\Ucitele", mappedBy="trida")
     */
    private $ucitel;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Zak", mappedBy="trida")
     */
    private $zak;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Skola", inversedBy="trida")
     */
    private $skola;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cas", mappedBy="trida")
     */
    private $cas;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Ucebna", inversedBy="trida", cascade={"persist", "remove"})
     */
    private $ucebna;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\VybranePredmety", inversedBy="trida")
     */
    private $vybranePredmety;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Historie", mappedBy="trida")
     */
    private $historie;





    public function __construct()
    {
        $this->ucitel = new ArrayCollection();
        $this->zak = new ArrayCollection();
        $this->cas = new ArrayCollection();
        $this->historie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
       return $this -> getNazev();
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

    /**
     * @return Collection|Ucitele[]
     */
    public function getUcitel(): ?Ucitele
    {
        return $this->ucitel;
    }

    public function addUcitel(Ucitele $ucitel): self
    {
        if (!$this->ucitel->contains($ucitel)) {
            $this->ucitel[] = $ucitel;
            $ucitel->setTrida($this);
        }

        return $this;
    }

    public function removeUcitel(Ucitele $ucitel): self
    {
        if ($this->ucitel->contains($ucitel)) {
            $this->ucitel->removeElement($ucitel);
            // set the owning side to null (unless already changed)
            if ($ucitel->getTrida() === $this) {
                $ucitel->setTrida(null);
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
            $zak->setTrida($this);
        }

        return $this;
    }

    public function removeZak(Zak $zak): self
    {
        if ($this->zak->contains($zak)) {
            $this->zak->removeElement($zak);
            // set the owning side to null (unless already changed)
            if ($zak->getTrida() === $this) {
                $zak->setTrida(null);
            }
        }

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
            $ca->setTrida($this);
        }

        return $this;
    }

    public function removeCa(Cas $ca): self
    {
        if ($this->cas->contains($ca)) {
            $this->cas->removeElement($ca);
            // set the owning side to null (unless already changed)
            if ($ca->getTrida() === $this) {
                $ca->setTrida(null);
            }
        }

        return $this;
    }

    public function getUcebna(): ?Ucebna
    {
        return $this->ucebna;
    }

    public function setUcebna(?Ucebna $ucebna): self
    {
        $this->ucebna = $ucebna;

        return $this;
    }

    public function getVybranePredmety(): ?VybranePredmety
    {
        return $this->vybranePredmety;
    }

    public function setVybranePredmety(?VybranePredmety $vybranePredmety): self
    {
        $this->vybranePredmety = $vybranePredmety;

        return $this;
    }

    /**
     * @return Collection|Historie[]
     */
    public function getHistorie(): Collection
    {
        return $this->historie;
    }

    public function addHistorie(Historie $historie): self
    {
        if (!$this->historie->contains($historie)) {
            $this->historie[] = $historie;
            $historie->addTrida($this);
        }

        return $this;
    }

    public function removeHistorie(Historie $historie): self
    {
        if ($this->historie->contains($historie)) {
            $this->historie->removeElement($historie);
            $historie->removeTrida($this);
        }

        return $this;
    }





}
