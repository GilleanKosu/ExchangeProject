<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CiudadRepository")
 */
class Ciudad
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="ciudad")
     */
    private $nombreCiudad;

    public function __construct()
    {
        $this->nombreCiudad = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|User[]
     */
    public function getNombreCiudad(): Collection
    {
        return $this->nombreCiudad;
    }

    public function addNombreCiudad(User $nombreCiudad): self
    {
        if (!$this->nombreCiudad->contains($nombreCiudad)) {
            $this->nombreCiudad[] = $nombreCiudad;
            $nombreCiudad->setCiudad($this);
        }

        return $this;
    }

    public function removeNombreCiudad(User $nombreCiudad): self
    {
        if ($this->nombreCiudad->contains($nombreCiudad)) {
            $this->nombreCiudad->removeElement($nombreCiudad);
            // set the owning side to null (unless already changed)
            if ($nombreCiudad->getCiudad() === $this) {
                $nombreCiudad->setCiudad(null);
            }
        }

        return $this;
    }
}
