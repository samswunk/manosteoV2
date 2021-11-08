<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PatientRepository::class)
 */
class Patient
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
    private $Nom;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sexe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Profession;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $Secu;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $remarques;

    /**
     * @ORM\ManyToOne(targetEntity=Adresse::class, inversedBy="patients", cascade={"persist", "remove"})
     */
    private $adresse;

    /**
     * @ORM\OneToOne(targetEntity=Telephone::class, cascade={"persist", "remove"})
     */
    private $telephone;

    /**
     * @ORM\OneToOne(targetEntity=Antecedent::class, cascade={"persist", "remove"})
     */
    private $antecedent;

    /**
     * @ORM\OneToOne(targetEntity=Accouchement::class, cascade={"persist", "remove"})
     */
    private $accouchement;

    /**
     * @ORM\OneToOne(targetEntity=Pediatrie::class, cascade={"persist", "remove"})
     */
    private $pediatrie;

    /**
     * @ORM\OneToOne(targetEntity=Traumato::class, cascade={"persist", "remove"})
     */
    private $traumato;

    /**
     * @ORM\OneToMany(targetEntity=Consultation::class, mappedBy="patient")
     */
    private $consultations;

    /**
     * @ORM\OneToOne(targetEntity=EnvoyePar::class, cascade={"persist", "remove"})
     */
    private $envoyePar;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $NbEnfant;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $situation;

    public function __construct()
    {
        $this->consultations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getSexe(): ?int
    {
        return $this->sexe;
    }

    public function setSexe(?int $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->Profession;
    }

    public function setProfession(?string $Profession): self
    {
        $this->Profession = $Profession;

        return $this;
    }

    public function getSecu(): ?string
    {
        return $this->Secu;
    }

    public function setSecu(?string $Secu): self
    {
        $this->Secu = $Secu;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(?\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getRemarques(): ?string
    {
        return $this->remarques;
    }

    public function setRemarques(?string $remarques): self
    {
        $this->remarques = $remarques;

        return $this;
    }

    public function getAdresse(): ?adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?adresse $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?telephone
    {
        return $this->telephone;
    }

    public function setTelephone(?telephone $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAntecedent(): ?Antecedent
    {
        return $this->antecedent;
    }

    public function setAntecedent(?Antecedent $antecedent): self
    {
        $this->antecedent = $antecedent;

        return $this;
    }

    public function getAccouchement(): ?Accouchement
    {
        return $this->accouchement;
    }

    public function setAccouchement(?Accouchement $accouchement): self
    {
        $this->accouchement = $accouchement;

        return $this;
    }

    public function getPediatrie(): ?Pediatrie
    {
        return $this->pediatrie;
    }

    public function setPediatrie(?Pediatrie $pediatrie): self
    {
        $this->pediatrie = $pediatrie;

        return $this;
    }

    public function getTraumato(): ?Traumato
    {
        return $this->traumato;
    }

    public function setTraumato(?Traumato $traumato): self
    {
        $this->traumato = $traumato;

        return $this;
    }

    /**
     * @return Collection|Consultation[]
     */
    public function getConsultations(): Collection
    {
        return $this->consultations;
    }

    public function addConsultation(Consultation $consultation): self
    {
        if (!$this->consultations->contains($consultation)) {
            $this->consultations[] = $consultation;
            $consultation->setPatient($this);
        }

        return $this;
    }

    public function removeConsultation(Consultation $consultation): self
    {
        if ($this->consultations->removeElement($consultation)) {
            // set the owning side to null (unless already changed)
            if ($consultation->getPatient() === $this) {
                $consultation->setPatient(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getEnvoyePar();
    }

    public function getEnvoyePar(): ?EnvoyePar
    {
        return $this->envoyePar;
    }

    public function setEnvoyePar(?EnvoyePar $envoyePar): self
    {
        $this->envoyePar = $envoyePar;

        return $this;
    }

    public function getNbEnfant(): ?int
    {
        return $this->NbEnfant;
    }

    public function setNbEnfant(?int $NbEnfant): self
    {
        $this->NbEnfant = $NbEnfant;

        return $this;
    }

    public function getSituation(): ?string
    {
        return $this->situation;
    }

    public function setSituation(?string $situation): self
    {
        $this->situation = $situation;

        return $this;
    }
}
