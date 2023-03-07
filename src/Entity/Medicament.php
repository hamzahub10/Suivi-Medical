<?php

namespace App\Entity;

use App\Repository\MedicamentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MedicamentRepository::class)]
class Medicament
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"libelle required")]
    private ?string $libelle = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"fabricant required")]
    private ?string $fabricant = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"durée de conservation required")]
    private ?string $duree_conservation = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"forme required")]
    private ?string $forme = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"gamme required")]
    private ?string $gamme = null;

    #[ORM\ManyToMany(targetEntity: Ordonnance::class, mappedBy: 'ord')]
    private Collection $medic;

    public function __construct()
    {
        $this->medic = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getFabricant(): ?string
    {
        return $this->fabricant;
    }

    public function setFabricant(string $fabricant): self
    {
        $this->fabricant = $fabricant;

        return $this;
    }

    public function getDureeConservation(): ?string
    {
        return $this->duree_conservation;
    }

    public function setDureeConservation(string $duree_conservation): self
    {
        $this->duree_conservation = $duree_conservation;

        return $this;
    }

    public function getForme(): ?string
    {
        return $this->forme;
    }

    public function setForme(string $forme): self
    {
        $this->forme = $forme;

        return $this;
    }

    public function getGamme(): ?string
    {
        return $this->gamme;
    }

    public function setGamme(string $gamme): self
    {
        $this->gamme = $gamme;

        return $this;
    }

    /**
     * @return Collection<int, Ordonnance>
     */
    public function getMedic(): Collection
    {
        return $this->medic;
    }

    public function addMedic(Ordonnance $medic): self
    {
        if (!$this->medic->contains($medic)) {
            $this->medic->add($medic);
            $medic->addOrd($this);
        }

        return $this;
    }

    public function removeMedic(Ordonnance $medic): self
    {
        if ($this->medic->removeElement($medic)) {
            $medic->removeOrd($this);
        }

        return $this;
    }
    public function __toString()
    {
        return $this->id;
    }

}
