<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PatientRepository::class)]
class Patient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_patient = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message:"Ce champ ne peut être vide")]
    #[Assert\Regex(pattern: "/^[A-Z]+$/i", message: "Doit commencer par la lettre majiscule", htmlPattern: "[A-Z]+")]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message:"Ce champ ne peut être vide")]
    #[Assert\Regex(pattern: "/^[A-Z]+$/i", message: "Doit commencer par la lettre majiscule", htmlPattern: "[A-Z]+")]
    private ?string $prenom = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message:"Ce champ ne peut être vide")]
    #[Assert\Email(message:"le format saisie ne correspond pas à celui d'un email")]
    private ?string $email = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank(message:"Ce champ ne peut être vide")]
    private ?string $motpasse = null;

    #[ORM\OneToMany(mappedBy: 'id_patient', targetEntity: Reclamation::class)]
    private Collection $reclamations;

    public function __construct()
    {
        $this->reclamations = new ArrayCollection();
    }

   /* public function getId(): ?int
    {
        return $this->id;
    }*/

    public function getId_Patient(): ?int
    {
        return $this->id_patient;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMotPasse(): ?string
    {
        return $this->motpasse;
    }

    public function setMotPasse(string $motpasse): self
    {
        $this->motpasse = $motpasse;

        return $this;
    }

    /**
     * @return Collection<int, Reclamation>
     */
    public function getReclamations(): Collection
    {
        return $this->reclamations;
    }

    public function addReclamation(Reclamation $reclamation): self
    {
        if (!$this->reclamations->contains($reclamation)) {
            $this->reclamations->add($reclamation);
            $reclamation->setIdPatient($this);
        }

        return $this;
    }

    public function removeReclamation(Reclamation $reclamation): self
    {
        if ($this->reclamations->removeElement($reclamation)) {
            // set the owning side to null (unless already changed)
            if ($reclamation->getIdPatient() === $this) {
                $reclamation->setIdPatient(null);
            }
        }

        return $this;
    }
}
