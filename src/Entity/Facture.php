<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FactureRepository::class)
 */
class Facture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $tarif;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $paiement;

    /**
     * @ORM\Column(type="string", length=35, nullable=true)
     */
    private $numeroCheque;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $regler;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numero;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $impression;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTarif(): ?string
    {
        return $this->tarif;
    }

    public function setTarif(string $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function getPaiement(): ?bool
    {
        return $this->paiement;
    }

    public function setPaiement(?bool $paiement): self
    {
        $this->paiement = $paiement;

        return $this;
    }

    public function getNumeroCheque(): ?string
    {
        return $this->numeroCheque;
    }

    public function setNumeroCheque(?string $numeroCheque): self
    {
        $this->numeroCheque = $numeroCheque;

        return $this;
    }

    public function getRegler(): ?bool
    {
        return $this->regler;
    }

    public function setRegler(?bool $regler): self
    {
        $this->regler = $regler;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getImpression(): ?bool
    {
        return $this->impression;
    }

    public function setImpression(?bool $impression): self
    {
        $this->impression = $impression;

        return $this;
    }
}
