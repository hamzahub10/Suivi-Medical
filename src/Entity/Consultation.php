<?php

namespace App\Entity;

use App\Repository\ConsultationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ConsultationRepository::class)]
class Consultation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"link required")]
    private ?string $lien_visio = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"price required")]
    private ?int $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $lien_enregistrement = null;

    #[ORM\OneToOne(inversedBy: 'do', cascade: ['persist', 'remove'])]
    private ?Rdv $consul = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLienVisio(): ?string
    {
        return $this->lien_visio;
    }

    public function setLienVisio(string $lien_visio): self
    {
        $this->lien_visio = $lien_visio;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getLienEnregistrement(): ?string
    {
        return $this->lien_enregistrement;
    }

    public function setLienEnregistrement(string $lien_enregistrement): self
    {
        $this->lien_enregistrement = $lien_enregistrement;

        return $this;
    }

    public function getConsul(): ?Rdv
    {
        return $this->consul;
    }

    public function setConsul(?Rdv $consul): self
    {
        $this->consul = $consul;

        return $this;
    }

}
