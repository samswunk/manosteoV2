<?php

namespace App\Entity;

use App\Repository\ParamRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParamRepository::class)
 */
class Param
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $tarif;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $devise;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $fondOk;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fondLink;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     */
    private $osteo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
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

    public function getDevise(): ?string
    {
        return $this->devise;
    }

    public function setDevise(string $devise): self
    {
        $this->devise = $devise;

        return $this;
    }

    public function getFondOk(): ?bool
    {
        return $this->fondOk;
    }

    public function setFondOk(?bool $fondOk): self
    {
        $this->fondOk = $fondOk;

        return $this;
    }

    public function getFondLink(): ?string
    {
        return $this->fondLink;
    }

    public function setFondLink(?string $fondLink): self
    {
        $this->fondLink = $fondLink;

        return $this;
    }

    public function getOsteo(): ?User
    {
        return $this->osteo;
    }

    public function setOsteo(?User $osteo): self
    {
        $this->osteo = $osteo;

        return $this;
    }
}
