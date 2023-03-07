<?php

namespace App\Entity;

use App\Repository\RdvRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RdvRepository::class)]
class Rdv
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message:"date required")]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"heure required")]
    private ?int $heure = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"confirmation required")]
    private ?string $confirmation = null;

    #[ORM\OneToOne(mappedBy: 'consul', cascade: ['persist', 'remove'])]
    private ?Consultation $do = null;

    #[ORM\ManyToOne(inversedBy: 'user_rdv')]
    private ?User $rdv_user = null;


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

    public function getHeure(): ?int
    {
        return $this->heure;
    }

    public function setHeure(int $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getConfirmation(): ?string
    {
        return $this->confirmation;
    }

    public function setConfirmation(string $confirmation): self
    {
        $this->confirmation = $confirmation;

        return $this;
    }

    public function getDo(): ?Consultation
    {
        return $this->do;
    }

    public function setDo(?Consultation $do): self
    {
        // unset the owning side of the relation if necessary
        if ($do === null && $this->do !== null) {
            $this->do->setConsul(null);
        }

        // set the owning side of the relation if necessary
        if ($do !== null && $do->getConsul() !== $this) {
            $do->setConsul($this);
        }

        $this->do = $do;

        return $this;
    }

    public function getRdvUser(): ?User
    {
        return $this->rdv_user;
    }

    public function setRdvUser(?User $rdv_user): self
    {
        $this->rdv_user = $rdv_user;

        return $this;
    }
    public function __toString()
    {
        return $this->id;
    }

}
