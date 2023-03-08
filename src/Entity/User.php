<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomPrenom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $pwd = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_naissance = null;

    #[ORM\Column]
    private ?int $numero = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[ORM\Column(length: 255)]
    private ?string $cv = null;

    #[ORM\OneToMany(mappedBy: 'rdv_user', targetEntity: Rdv::class)]
    private Collection $user_rdv;

    #[ORM\OneToMany(mappedBy: 'ord_user', targetEntity: Ordonnance::class)]
    private Collection $user_ord;

    public function __construct()
    {
        $this->user_rdv = new ArrayCollection();
        $this->user_ord = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPrenom(): ?string
    {
        return $this->nomPrenom;
    }

    public function setNomPrenom(string $nomPrenom): self
    {
        $this->nomPrenom = $nomPrenom;

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

    public function getPwd(): ?string
    {
        return $this->pwd;
    }

    public function setPwd(string $pwd): self
    {
        $this->pwd = $pwd;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(string $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * @return Collection<int, Rdv>
     */
    public function getUserRdv(): Collection
    {
        return $this->user_rdv;
    }

    public function addUserRdv(Rdv $userRdv): self
    {
        if (!$this->user_rdv->contains($userRdv)) {
            $this->user_rdv->add($userRdv);
            $userRdv->setRdvUser($this);
        }

        return $this;
    }

    public function removeUserRdv(Rdv $userRdv): self
    {
        if ($this->user_rdv->removeElement($userRdv)) {
            // set the owning side to null (unless already changed)
            if ($userRdv->getRdvUser() === $this) {
                $userRdv->setRdvUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ordonnance>
     */
    public function getUserOrd(): Collection
    {
        return $this->user_ord;
    }

    public function addUserOrd(Ordonnance $userOrd): self
    {
        if (!$this->user_ord->contains($userOrd)) {
            $this->user_ord->add($userOrd);
            $userOrd->setOrdUser($this);
        }

        return $this;
    }

    public function removeUserOrd(Ordonnance $userOrd): self
    {
        if ($this->user_ord->removeElement($userOrd)) {
            // set the owning side to null (unless already changed)
            if ($userOrd->getOrdUser() === $this) {
                $userOrd->setOrdUser(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->nomPrenom;
    }

}
