<?php

namespace App\Entity;

use App\Repository\AccouchementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AccouchementRepository::class)
 */
class Accouchement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $difficultes;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $conditions;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $peridurale;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $episiotomie;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $instrumentalisation;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $presentation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $remarques;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDifficultes(): ?bool
    {
        return $this->difficultes;
    }

    public function setDifficultes(?bool $difficultes): self
    {
        $this->difficultes = $difficultes;

        return $this;
    }

    public function getConditions(): ?bool
    {
        return $this->conditions;
    }

    public function setConditions(?bool $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function getPeridurale(): ?bool
    {
        return $this->peridurale;
    }

    public function setPeridurale(?bool $peridurale): self
    {
        $this->peridurale = $peridurale;

        return $this;
    }

    public function getEpisiotomie(): ?bool
    {
        return $this->episiotomie;
    }

    public function setEpisiotomie(?bool $episiotomie): self
    {
        $this->episiotomie = $episiotomie;

        return $this;
    }

    public function getInstrumentalisation(): ?bool
    {
        return $this->instrumentalisation;
    }

    public function setInstrumentalisation(?bool $instrumentalisation): self
    {
        $this->instrumentalisation = $instrumentalisation;

        return $this;
    }

    public function getPresentation(): ?bool
    {
        return $this->presentation;
    }

    public function setPresentation(?bool $presentation): self
    {
        $this->presentation = $presentation;

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
