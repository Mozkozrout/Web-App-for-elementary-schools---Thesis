<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UciteleRepository")
 */
class Ucitele
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $Jmeno;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prijmeni;

    /**
     * @ORM\Column(type="date")
     */
    private $datNar;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $image;

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
     * @ORM\OneToOne(targetEntity="App\Entity\Trida", inversedBy="ucitel")
     */
    private $trida;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Skola", inversedBy="ucitel")
     */
    private $skola;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cas", mappedBy="ucitel")
     */
    private $cas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Znamka", mappedBy="ucitel")
     */
    private $znamka;

    /**
     * @ORM\Column(type="smallint")
     */
    private $psc;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $poznamka;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ucebna", inversedBy="ucitele")
     */
    private $ucebna;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $telefon;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $web;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", mappedBy="ucitel", cascade={"persist", "remove"})
     */
    private $user;

    public function __construct()
    {
        $this->cas = new ArrayCollection();
        $this->znamka = new ArrayCollection();
    }

    public function __toString()
    {
        return $this -> Jmeno . ' ' . $this -> prijmeni;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJmeno(): ?string
    {
        return $this->Jmeno;
    }

    public function setJmeno(?string $Jmeno): self
    {
        $this->Jmeno = $Jmeno;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getTrida(): ?Trida
    {
        return $this->trida;
    }

    public function setTrida(?Trida $trida): self
    {
        $this->trida = $trida;

        return $this;
    }

    public function getPrijmeni(): ?string
    {
        return $this->prijmeni;
    }

    public function setPrijmeni(string $prijmeni): self
    {
        $this->prijmeni = $prijmeni;

        return $this;
    }

    public function getDatNar(): ?\DateTimeInterface
    {
        return $this->datNar;
    }

    public function setDatNar(\DateTimeInterface $datNar): self
    {
        $this->datNar = $datNar;

        return $this;
    }

    public function getStat(): ?string
    {
        return $this->stat;
    }

    public function setStat(?string $stat): self
    {
        $this->stat = $stat;

        return $this;
    }

    public function getMesto(): ?string
    {
        return $this->mesto;
    }

    public function setMesto(?string $mesto): self
    {
        $this->mesto = $mesto;

        return $this;
    }

    public function getUlice(): ?string
    {
        return $this->ulice;
    }

    public function setUlice(?string $ulice): self
    {
        $this->ulice = $ulice;

        return $this;
    }

    public function getCisPop(): ?string
    {
        return $this->cisPop;
    }

    public function setCisPop(?string $cisPop): self
    {
        $this->cisPop = $cisPop;

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
            $ca->setUcitel($this);
        }

        return $this;
    }

    public function removeCa(Cas $ca): self
    {
        if ($this->cas->contains($ca)) {
            $this->cas->removeElement($ca);
            // set the owning side to null (unless already changed)
            if ($ca->getUcitel() === $this) {
                $ca->setUcitel(null);
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
            $znamka->setUcitel($this);
        }

        return $this;
    }

    public function removeZnamka(Znamka $znamka): self
    {
        if ($this->znamka->contains($znamka)) {
            $this->znamka->removeElement($znamka);
            // set the owning side to null (unless already changed)
            if ($znamka->getUcitel() === $this) {
                $znamka->setUcitel(null);
            }
        }

        return $this;
    }

    public function getPsc(): ?int
    {
        return $this->psc;
    }

    public function setPsc(?int $psc): self
    {
        $this->psc = $psc;

        return $this;
    }

    public function getPoznamka(): ?string
    {
        return $this->poznamka;
    }

    public function setPoznamka(?string $poznamka): self
    {
        $this->poznamka = $poznamka;

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

    public function getTelefon(): ?string
    {
        return $this->telefon;
    }

    public function setTelefon(?string $telefon): self
    {
        $this->telefon = $telefon;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getWeb(): ?string
    {
        return $this->web;
    }

    public function setWeb(?string $web): self
    {
        $this->web = $web;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        // set (or unset) the owning side of the relation if necessary
        $newUcitel = null === $user ? null : $this;
        if ($user->getUcitel() !== $newUcitel) {
            $user->setUcitel($newUcitel);
        }

        return $this;
    }
}
