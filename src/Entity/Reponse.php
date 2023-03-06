<?php

namespace App\Entity;

use App\Repository\ReponseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReponseRepository::class)]
class Reponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_reponse = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_reponse = null;

    #[ORM\Column(length: 100)]
    private ?string $solution_reponse = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdReponse(): ?int
    {
        return $this->id_reponse;
    }

    public function setIdReponse(int $id_reponse): self
    {
        $this->id_reponse = $id_reponse;

        return $this;
    }

    public function getDateReponse(): ?\DateTimeInterface
    {
        return $this->date_reponse;
    }

    public function setDateReponse(\DateTimeInterface $date_reponse): self
    {
        $this->date_reponse = $date_reponse;

        return $this;
    }

    public function getSolutionReponse(): ?string
    {
        return $this->solution_reponse;
    }

    public function setSolutionReponse(string $solution_reponse): self
    {
        $this->solution_reponse = $solution_reponse;

        return $this;
    }
}
