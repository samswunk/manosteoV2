<?php

namespace App\Entity;

use App\Repository\TraumatoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TraumatoRepository::class)
 */
class Traumato
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
    private $fractures;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $entorses;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $accidents;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $operations;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFractures(): ?string
    {
        return $this->fractures;
    }

    public function setFractures(?string $fractures): self
    {
        $this->fractures = $fractures;

        return $this;
    }

    public function getEntorses(): ?string
    {
        return $this->entorses;
    }

    public function setEntorses(?string $entorses): self
    {
        $this->entorses = $entorses;

        return $this;
    }

    public function getAccidents(): ?string
    {
        return $this->accidents;
    }

    public function setAccidents(?string $accidents): self
    {
        $this->accidents = $accidents;

        return $this;
    }

    public function getOperations(): ?string
    {
        return $this->operations;
    }

    public function setOperations(?string $operations): self
    {
        $this->operations = $operations;

        return $this;
    }
}
