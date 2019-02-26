<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServicioRepository")
 */
class Servicio
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duracion_servicio;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion_servicio;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categoria", inversedBy="servicios")
     */
    private $id_categoria;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $horas_dia;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="servicios")
     */
    private $usuario;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $hora_servicio;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ciudad", inversedBy="servicios", cascade={"persist"})
     */
    private $ciudad_servicio;

    public function __construct()
    {
        $this->usuario = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDuracionServicio(): ?int
    {
        return $this->duracion_servicio;
    }

    public function setDuracionServicio(?int $duracion_servicio): self
    {
        $this->duracion_servicio = $duracion_servicio;

        return $this;
    }

    public function getDescripcionServicio(): ?string
    {
        return $this->descripcion_servicio;
    }

    public function setDescripcionServicio(?string $descripcion_servicio): self
    {
        $this->descripcion_servicio = $descripcion_servicio;

        return $this;
    }

    public function getIdCategoria(): ?Categoria
    {
        return $this->id_categoria;
    }

    public function setIdCategoria(?Categoria $id_categoria): self
    {
        $this->id_categoria = $id_categoria;

        return $this;
    }

    public function getHorasDia(): ?int
    {
        return $this->horas_dia;
    }

    public function setHorasDia(?int $horas_dia): self
    {
        $this->horas_dia = $horas_dia;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsuario(): Collection
    {
        return $this->usuario;
    }

    public function addUsuario(User $usuario): self
    {
        if (!$this->usuario->contains($usuario)) {
            $this->usuario[] = $usuario;
        }

        return $this;
    }

    public function removeUsuario(User $usuario): self
    {
        if ($this->usuario->contains($usuario)) {
            $this->usuario->removeElement($usuario);
        }

        return $this;
    }

    public function getHoraServicio(): ?string
    {
        return $this->hora_servicio;
    }

    public function setHoraServicio(?string $hora_servicio): self
    {
        $this->hora_servicio = $hora_servicio;

        return $this;
    }

    public function getCiudadServicio(): ?Ciudad
    {
        return $this->ciudad_servicio;
    }

    public function setCiudadServicio(?Ciudad $ciudad_servicio): self
    {
        $this->ciudad_servicio = $ciudad_servicio;

        return $this;
    }
    public function __toString()
    {
        return $this->descripcion_servicio;
    }

}
