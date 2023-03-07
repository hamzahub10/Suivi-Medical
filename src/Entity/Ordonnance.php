<?php

namespace App\Entity;

use App\Repository\OrdonnanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OrdonnanceRepository::class)]
class Ordonnance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message:"date required")]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"nombre de paquets required")]
    private ?int $nb_paquet = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"dosage required")]
    private ?int $dosage = null;

    #[ORM\Column(length: 255)]
    private ?string $remarque = null;

    #[ORM\ManyToMany(targetEntity: Medicament::class, inversedBy: 'medic')]
    private Collection $ord;

    #[ORM\ManyToOne(inversedBy: 'user_ord')]
    private ?User $ord_user = null;

    public function __construct()
    {
        $this->ord = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNbPaquet(): ?int
    {
        return $this->nb_paquet;
    }

    public function setNbPaquet(int $nb_paquet): self
    {
        $this->nb_paquet = $nb_paquet;

        return $this;
    }

    public function getDosage(): ?int
    {
        return $this->dosage;
    }

    public function setDosage(int $dosage): self
    {
        $this->dosage = $dosage;

        return $this;
    }

    public function getRemarque(): ?string
    {
        return $this->remarque;
    }

    public function setRemarque(string $remarque): self
    {
        $this->remarque = $remarque;

        return $this;
    }

    /**
     * @return Collection<int, Medicament>
     */
    public function getOrd(): Collection
    {
        return $this->ord;
    }

    public function addOrd(Medicament $ord): self
    {
        if (!$this->ord->contains($ord)) {
            $this->ord->add($ord);
        }

        return $this;
    }

    public function removeOrd(Medicament $ord): self
    {
        $this->ord->removeElement($ord);

        return $this;
    }

    public function getOrdUser(): ?User
    {
        return $this->ord_user;
    }

    public function setOrdUser(?User $ord_user): self
    {
        $this->ord_user = $ord_user;

        return $this;
    }
    public function __toString()
    {
        return $this->id;
    }

}
