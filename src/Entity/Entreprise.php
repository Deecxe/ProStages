<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 */
class Entreprise
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * *@Assert\NotBlank;
     * *@Assert\Length(min=4,minMessage="Le nom de l entreprise doit au moins faire 4 caractére");
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * *@Assert\NotBlank;
     * *@Assert\Regex(pattern="# (rue|boulevard|avenue|impasse|allée|place|voie|allee) #i",message="Le type de voie/rue semble incorrect");
     * *@Assert\Regex(pattern="#^[1-999]( )?(bis)? #", message="Le numéro de route semble incorrect");
     * *@Assert\Regex(pattern="# [0-9]{5} #",message="Il semble y avoir un probleme avec le code postal");
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     * *@Assert\NotBlank;
     */
    private $activite;

    /**
     * @ORM\Column(type="string", length=255)
     * *@Assert\Url;
     */
    private $siteweb;

    /**
     * @ORM\OneToMany(targetEntity=Stage::class, mappedBy="typeEntreprise")
     */
    private $stages;

    public function __construct()
    {
        $this->stages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getActivite(): ?string
    {
        return $this->activite;
    }

    public function setActivite(string $activite): self
    {
        $this->activite = $activite;

        return $this;
    }

    public function getSiteweb(): ?string
    {
        return $this->siteweb;
    }

    public function setSiteweb(string $siteweb): self
    {
        $this->siteweb = $siteweb;

        return $this;
    }

    /**
     * @return Collection|Stage[]
     */
    public function getStages(): Collection
    {
        return $this->stages;
    }

    public function addStage(Stage $stage): self
    {
        if (!$this->stages->contains($stage)) {
            $this->stages[] = $stage;
            $stage->setTypeEntreprise($this);
        }

        return $this;
    }

    public function removeStage(Stage $stage): self
    {
        if ($this->stages->removeElement($stage)) {
            // set the owning side to null (unless already changed)
            if ($stage->getTypeEntreprise() === $this) {
                $stage->setTypeEntreprise(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getNom();
    }
}
