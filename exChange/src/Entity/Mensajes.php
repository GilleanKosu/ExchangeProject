<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MensajesRepository")
 */
class Mensajes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $remitente;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="mensajes")
     */
    private $destinatario;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contenido;

    public function __construct()
    {
        $this->destinatario = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRemitente(): ?string
    {
        return $this->remitente;
    }

    public function setRemitente(?string $remitente): self
    {
        $this->remitente = $remitente;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getDestinatario(): Collection
    {
        return $this->destinatario;
    }

    public function addDestinatario(User $destinatario): self
    {
        if (!$this->destinatario->contains($destinatario)) {
            $this->destinatario[] = $destinatario;
        }

        return $this;
    }

    public function removeDestinatario(User $destinatario): self
    {
        if ($this->destinatario->contains($destinatario)) {
            $this->destinatario->removeElement($destinatario);
        }

        return $this;
    }

    public function getContenido(): ?string
    {
        return $this->contenido;
    }

    public function setContenido(?string $contenido): self
    {
        $this->contenido = $contenido;

        return $this;
    }
}
