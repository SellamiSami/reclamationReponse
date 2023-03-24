<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;




#[ORM\Entity(repositoryClass: ReclamationRepository::class)]
class Reclamation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_reclamation = null;


    
    #[ORM\Column(length: 50)]
    #[Assert\Length(min: 3)]
    private ?string $titre_reclamation = null;

    #[ORM\Column(length: 100)]
    // #[Assert\NotBlank(message:"Ce champ ne peut être vide")]
    // #[Assert\Regex(pattern: "/^[A-Z]+$/i", message: "Doit commencer par la lettre majiscule", htmlPattern: "[A-Z]+")]
    private ?string $description_reclamation = null;

    #[ORM\Column(length: 25)]
    private ?string $type_reclamation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\GreaterThanOrEqual("today")]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 10)]
    private ?string $etat_reclamation = null;

    #[ORM\OneToMany(mappedBy: 'idReclamation', targetEntity: Reponse::class)]
    private Collection $lesReponses;

    

    public function __construct()
    {
        $this->lesReponses = new ArrayCollection();
    }

    
    

    

    public function getId_Reclamation(): ?int
    {
        return $this->id_reclamation;
    }   

    public function setId_Reclamation(int $id_reclamation): self
    {
        $this->id_reclamation = $id_reclamation;

        return $this;
    }

    public function getTitreReclamation(): ?string
    {
        return $this->titre_reclamation;
    }

    public function setTitreReclamation(string $titre_reclamation): self
    {
        $this->titre_reclamation = $titre_reclamation;

        return $this;
    }

    public function getDescriptionReclamation(): ?string
    {
        return $this->description_reclamation;
    }

    public function setDescriptionReclamation(string $description_reclamation): self
    {
        $this->description_reclamation = $description_reclamation;

        return $this;
    }

    public function getTypeReclamation(): ?string
    {
        return $this->type_reclamation;
    }

    public function setTypeReclamation(string $type_reclamation): self
    {
        $this->type_reclamation = $type_reclamation;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
        // ->format('Y-m-d')
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEtatReclamation(): ?string
    {
        return $this->etat_reclamation;
    }

    public function setEtatReclamation(string $etat_reclamation): self
    {
        $this->etat_reclamation = $etat_reclamation;

        return $this;
    }

    /**
     * @return Collection<int, Reponse>
     */
    public function getLesReponses(): Collection
    {
        return $this->lesReponses;
    }

    public function addLesReponse(Reponse $lesReponse): self
    {
        if (!$this->lesReponses->contains($lesReponse)) {
            $this->lesReponses->add($lesReponse);
            $lesReponse->setIdReclamation($this);
        }

        return $this;
    }

    public function removeLesReponse(Reponse $lesReponse): self
    {
        if ($this->lesReponses->removeElement($lesReponse)) {
            // set the owning side to null (unless already changed)
            if ($lesReponse->getIdReclamation() === $this) {
                $lesReponse->setIdReclamation(null);
            }
        }

        return $this;
    }

    public function getIdPatient(): ?Patient
    {
        return $this->id_patient;
    }

    public function setIdPatient(?Patient $id_patient): self
    {
        $this->id_patient = $id_patient;

        return $this;
    }

    

    

    
}
