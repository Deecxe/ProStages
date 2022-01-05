<?php

namespace App\Entity;

use App\Repository\StageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StageRepository::class)
 */
class Stage
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mission;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity=entreprise::class, inversedBy="stages")
     */
    private $typeEntreprise;

    /**
     * @ORM\ManyToMany(targetEntity=formation::class, inversedBy="stages")
     */
    private $typeFormation;

    public function __construct()
    {
        $this->typeFormation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getMission(): ?string
    {
        return $this->mission;
    }

    public function setMission(string $mission): self
    {
        $this->mission = $mission;

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

    public function getTypeEntreprise(): ?entreprise
    {
        return $this->typeEntreprise;
    }

    public function setTypeEntreprise(?entreprise $typeEntreprise): self
    {
        $this->typeEntreprise = $typeEntreprise;

        return $this;
    }

    /**
     * @return Collection|formation[]
     */
    public function getTypeFormation(): Collection
    {
        return $this->typeFormation;
    }

    public function addTypeFormation(formation $typeFormation): self
    {
        if (!$this->typeFormation->contains($typeFormation)) {
            $this->typeFormation[] = $typeFormation;
        }

        return $this;
    }

    public function removeTypeFormation(formation $typeFormation): self
    {
        $this->typeFormation->removeElement($typeFormation);

        return $this;
    }
}
