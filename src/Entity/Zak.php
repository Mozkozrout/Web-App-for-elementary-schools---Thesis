<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ZakRepository")
 */
class Zak
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
    private $jmeno;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Trida", inversedBy="zak")
     * @ORM\JoinColumn(nullable=false)
     */
    private $trida;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Skola", inversedBy="zak")
     */
    private $skola;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Znamka", mappedBy="zak", orphanRemoval=true)
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
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $tel;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", mappedBy="zak", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Historie", mappedBy="zak")
     */
    private $historie;


    public function __construct()
    {
        $this->znamka = new ArrayCollection();
        $this->historie = new ArrayCollection();
    }

    public function __toString()
    {
        return $this -> jmeno . ' ' . $this -> prijmeni;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJmeno(): ?string
    {
        return $this->jmeno;
    }

    public function setJmeno(string $jmeno): self
    {
        $this->jmeno = $jmeno;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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

    public function getTrida(): ?Trida
    {
        return $this->trida;
    }

    public function setTrida(?Trida $trida): self
    {
        $this->trida = $trida;

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
            $znamka->setZak($this);
        }

        return $this;
    }

    public function removeZnamka(Znamka $znamka): self
    {
        if ($this->znamka->contains($znamka)) {
            $this->znamka->removeElement($znamka);
            // set the owning side to null (unless already changed)
            if ($znamka->getZak() === $this) {
                $znamka->setZak(null);
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

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

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
        $newZak = null === $user ? null : $this;
        if ($user->getZak() !== $newZak) {
            $user->setZak($newZak);
        }

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
            $historie->addZak($this);
        }

        return $this;
    }

    public function removeHistorie(Historie $historie): self
    {
        if ($this->historie->contains($historie)) {
            $this->historie->removeElement($historie);
            $historie->removeZak($this);
        }

        return $this;
    }


}
