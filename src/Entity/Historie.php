<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HistorieRepository")
 */
class Historie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $rok;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Trida", inversedBy="historie")
     */
    private $trida;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Zak", inversedBy="historie")
     */
    private $zak;

    public function __construct()
    {
        $this->trida = new ArrayCollection();
        $this->zak = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRok(): ?int
    {
        return $this->rok;
    }

    public function setRok(int $rok): self
    {
        $this->rok = $rok;

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
        }

        return $this;
    }

    public function removeTrida(Trida $trida): self
    {
        if ($this->trida->contains($trida)) {
            $this->trida->removeElement($trida);
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
        }

        return $this;
    }

    public function removeZak(Zak $zak): self
    {
        if ($this->zak->contains($zak)) {
            $this->zak->removeElement($zak);
        }

        return $this;
    }
}
