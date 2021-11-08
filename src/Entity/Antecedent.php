<?php

namespace App\Entity;

use App\Repository\AntecedentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AntecedentRepository::class)
 */
class Antecedent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $orl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $neuro;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $allergie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cardio;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $digest;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $uro;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gyneco;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sommeil;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $grossesse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vaccin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrl(): ?string
    {
        return $this->orl;
    }

    public function setOrl(?string $orl): self
    {
        $this->orl = $orl;

        return $this;
    }

    public function getNeuro(): ?string
    {
        return $this->neuro;
    }

    public function setNeuro(?string $neuro): self
    {
        $this->neuro = $neuro;

        return $this;
    }

    public function getVr(): ?string
    {
        return $this->vr;
    }

    public function setVr(?string $vr): self
    {
        $this->vr = $vr;

        return $this;
    }

    public function getAllergie(): ?string
    {
        return $this->allergie;
    }

    public function setAllergie(?string $allergie): self
    {
        $this->allergie = $allergie;

        return $this;
    }

    public function getCardio(): ?string
    {
        return $this->cardio;
    }

    public function setCardio(?string $cardio): self
    {
        $this->cardio = $cardio;

        return $this;
    }

    public function getDigest(): ?string
    {
        return $this->digest;
    }

    public function setDigest(?string $digest): self
    {
        $this->digest = $digest;

        return $this;
    }

    public function getUro(): ?string
    {
        return $this->uro;
    }

    public function setUro(?string $uro): self
    {
        $this->uro = $uro;

        return $this;
    }

    public function getGyneco(): ?string
    {
        return $this->gyneco;
    }

    public function setGyneco(?string $gyneco): self
    {
        $this->gyneco = $gyneco;

        return $this;
    }

    public function getSommeil(): ?string
    {
        return $this->sommeil;
    }

    public function setSommeil(?string $sommeil): self
    {
        $this->sommeil = $sommeil;

        return $this;
    }

    public function getGrossesse(): ?string
    {
        return $this->grossesse;
    }

    public function setGrossesse(?string $grossesse): self
    {
        $this->grossesse = $grossesse;

        return $this;
    }

    public function getVaccin(): ?string
    {
        return $this->vaccin;
    }

    public function setVaccin(?string $vaccin): self
    {
        $this->vaccin = $vaccin;

        return $this;
    }
}
