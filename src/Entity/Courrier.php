<?php

namespace App\Entity;

use App\Repository\CourrierRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CourrierRepository::class)
 */
class Courrier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $objet;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\OneToOne(targetEntity=Patient::class, cascade={"persist", "remove"})
     */
    private $patient;

    /**
     * @ORM\OneToOne(targetEntity=Confrere::class, cascade={"persist", "remove"})
     */
    private $confrere;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="courriers")
     */
    private $osteo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(?string $objet): self
    {
        $this->objet = $objet;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

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

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    public function getConfrere(): ?Confrere
    {
        return $this->confrere;
    }

    public function setConfrere(?Confrere $confrere): self
    {
        $this->confrere = $confrere;

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
