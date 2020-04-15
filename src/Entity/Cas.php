<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CasRepository")
 */
class Cas
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Den", inversedBy="cas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $den;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Predmet", inversedBy="cas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $predmet;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ucitele", inversedBy="cas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ucitel;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Trida", inversedBy="cas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $trida;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ucebna", inversedBy="cas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ucebna;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Doba", inversedBy="cas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $doba;


    public function getId(): ?int
    {
        return $this->id;
    }



    public function getDen(): ?Den
    {
        return $this->den;
    }

    public function setDen(?Den $den): self
    {
        $this->den = $den;

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

    public function getTrida(): ?Trida
    {
        return $this->trida;
    }

    public function setTrida(?Trida $trida): self
    {
        $this->trida = $trida;

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

    public function getDoba(): ?Doba
    {
        return $this->doba;
    }

    public function setDoba(?Doba $doba): self
    {
        $this->doba = $doba;

        return $this;
    }
}
