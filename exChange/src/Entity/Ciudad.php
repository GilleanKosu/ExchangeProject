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

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombreC;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Servicio", mappedBy="ciudad_servicio")
     */
    private $servicios;

    public function __construct()
    {
        $this->nombreCiudad = new ArrayCollection();
        $this->servicio = new ArrayCollection();
        $this->servicios = new ArrayCollection();
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

    public function getNombreC(): ?string
    {
        return $this->nombreC;
    }

    public function setNombreC(string $nombreC): self
    {
        $this->nombreC = $nombreC;

        return $this;
    }
    public function __toString()
    {
        return $this->nombreC;
    }

    /**
     * @return Collection|Servicio[]
     */
    public function getServicios(): Collection
    {
        return $this->servicios;
    }

    public function addServicio(Servicio $servicio): self
    {
        if (!$this->servicios->contains($servicio)) {
            $this->servicios[] = $servicio;
            $servicio->setCiudadServicio($this);
        }

        return $this;
    }

    public function removeServicio(Servicio $servicio): self
    {
        if ($this->servicios->contains($servicio)) {
            $this->servicios->removeElement($servicio);
            // set the owning side to null (unless already changed)
            if ($servicio->getCiudadServicio() === $this) {
                $servicio->setCiudadServicio(null);
            }
        }

        return $this;
    }

}
