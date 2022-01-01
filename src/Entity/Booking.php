<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookingRepository::class)
 */
class Booking
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="datetime")
     */
    private $start;

    /**
     * @ORM\Column(type="datetime")
     */
    private $end;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=8, nullable=true)
     */
    private $backgroundColor;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isFree;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isConfirmed;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $jauge;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="bookings")
     */
    private $idUser;
    
    // ,orphanRemoval=true, cascade={"persist"}
    
    /**
     * @ORM\ManyToOne(targetEntity=Patient::class, inversedBy="consultations")
     */
    private $patients;

    public function __construct()
    {
        $this->idUser = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getBackgroundColor(): ?string
    {
        return $this->backgroundColor;
    }

    public function setBackgroundColor(?string $backgroundColor): self
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }

    public function getIsFree(): ?bool
    {
        return $this->isFree;
    }

    public function setIsFree(?bool $isFree): self
    {
        $this->isFree = $isFree;
        if ($this->isFree) 
        {
            $this->setIdUser = null;
        }
        return $this;
    }

    public function getPatients(): ?Patient
    {
        return $this->patients;
    }

    public function setPatients(?Patient $patients): self
    {
        $this->patients = $patients;

        return $this;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->isFree = (bool) $this->isFree; //Force using boolean value of $this->active
        if ($this->isFree) {
            $this->setIdUser = null;
        }
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->isFree = (bool) $this->isFree;
        if ($this->IsFree) 
        {
            dd("preUpdate this->IsFree id ".$this->IsFree);
            $this->setIdUser = null;
        }
    }

    public function getIsConfirmed(): ?bool
    {
        return $this->isConfirmed;
    }

    public function setIsConfirmed(?bool $isConfirmed): self
    {
        $this->isConfirmed = $isConfirmed;

        return $this;
    }

    public function getJauge(): ?int
    {
        return $this->jauge;
    }

    public function setJauge(?int $jauge): self
    {
        $this->jauge = $jauge ?? 10;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getIdUser(): Collection
    {
        return $this->idUser;
    }

    public function addIdUser(User $idUser): self
    {
        if (!$this->idUser->contains($idUser)) {
            $this->idUser[] = $idUser;
        }

        return $this;
    }

    public function removeIdUser(User $idUser): self
    {
        if ($this->idUser->contains($idUser)) {
            $this->idUser->removeElement($idUser);
        }

        return $this;
    }    

    public function removeAllUser(): self
    {
        if ($this->idUser) {
            $this->idUser=[];
        }

        return $this;
    }    
}
