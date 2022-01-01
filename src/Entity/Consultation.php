<?php

namespace App\Entity;

use App\Repository\ConsultationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConsultationRepository::class)
 */
class Consultation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $motif;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $test;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $traitement;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $domicile;

    /**
     * @ORM\ManyToOne(targetEntity=Patient::class, inversedBy="consultations")
     */
    private $patient;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="consultations")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity=Facture::class, cascade={"persist", "remove"})
     */
    private $facture;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $IsConfirmed;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $IsFree;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $Titre;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(string $motif): self
    {
        $this->motif = $motif;

        return $this;
    }

    public function getTest(): ?string
    {
        return $this->test;
    }

    public function setTest(?string $test): self
    {
        $this->test = $test;

        return $this;
    }

    public function getTraitement(): ?string
    {
        return $this->traitement;
    }

    public function setTraitement(string $traitement): self
    {
        $this->traitement = $traitement;

        return $this;
    }

    public function getDomicile(): ?bool
    {
        return $this->domicile;
    }

    public function setDomicile(?bool $domicile): self
    {
        $this->domicile = $domicile;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getFacture(): ?Facture
    {
        return $this->facture;
    }

    public function setFacture(?Facture $facture): self
    {
        $this->facture = $facture;

        return $this;
    }

    public function getIsConfirmed(): ?bool
    {
        return $this->IsConfirmed;
    }

    public function setIsConfirmed(?bool $IsConfirmed): self
    {
        $this->IsConfirmed = $IsConfirmed;

        return $this;
    }

    public function getIsFree(): ?bool
    {
        return $this->IsFree;
    }

    public function setIsFree(?bool $IsFree): self
    {
        $this->IsFree = $IsFree;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(?string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }
}
