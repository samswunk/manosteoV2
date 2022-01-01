<?php

namespace App\Entity;

use App\Repository\PediatrieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PediatrieRepository::class)
 */
class Pediatrie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $taille;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=1, nullable=true)
     */
    private $poids;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pc;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $apgar1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $apgar5;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $apgar10;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $allaitement;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $tempsAllaitement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $remarques;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTaille(): ?int
    {
        return $this->taille;
    }

    public function setTaille(?int $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getPoids(): ?string
    {
        return $this->poids;
    }

    public function setPoids(?string $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getPc(): ?int
    {
        return $this->pc;
    }

    public function setPc(int $pc): self
    {
        $this->pc = $pc;

        return $this;
    }

    public function getApgar1(): ?int
    {
        return $this->apgar1;
    }

    public function setApgar1(?int $apgar1): self
    {
        $this->apgar1 = $apgar1;

        return $this;
    }

    public function getApgar5(): ?int
    {
        return $this->apgar5;
    }

    public function setApgar5(?int $apgar5): self
    {
        $this->apgar5 = $apgar5;

        return $this;
    }

    public function getApgar10(): ?int
    {
        return $this->apgar10;
    }

    public function setApgar10(?int $apgar10): self
    {
        $this->apgar10 = $apgar10;

        return $this;
    }

    public function getAllaitement(): ?bool
    {
        return $this->allaitement;
    }

    public function setAllaitement(?bool $allaitement): self
    {
        $this->allaitement = $allaitement;

        return $this;
    }

    public function getTempsAllaitement(): ?string
    {
        return $this->tempsAllaitement;
    }

    public function setTempsAllaitement(?string $tempsAllaitement): self
    {
        $this->tempsAllaitement = $tempsAllaitement;

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
}
