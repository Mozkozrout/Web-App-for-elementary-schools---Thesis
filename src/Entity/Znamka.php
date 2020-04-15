<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ZnamkaRepository")
 */
class Znamka
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $hodnota;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $poznamka;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Zak", inversedBy="znamka")
     * @ORM\JoinColumn(nullable=false)
     */
    private $zak;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Predmet", inversedBy="znamka")
     * @ORM\JoinColumn(nullable=false)
     */
    private $predmet;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ucitele", inversedBy="znamka")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ucitel;

    /**
     * @ORM\Column(type="date")
     */
    private $datum;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this -> hodnota;
    }

    public function getHodnota(): ?int
    {
        return $this->hodnota;
    }

    public function setHodnota(?int $hodnota): self
    {
        $this->hodnota = $hodnota;

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

    public function getZak(): ?Zak
    {
        return $this->zak;
    }

    public function setZak(?Zak $zak): self
    {
        $this->zak = $zak;

        return $this;
    }

    public function getPredmet(): ?Predmet
    {
        return $this->predmet;
    }

    public function setPredmet(?Predmet $predmet): self
    {
        $this->predmet = $predmet;

        return $this;
    }

    public function getUcitel(): ?Ucitele
    {
        return $this->ucitel;
    }

    public function setUcitel(?Ucitele $ucitel): self
    {
        $this->ucitel = $ucitel;

        return $this;
    }

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }
}
