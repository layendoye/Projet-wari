<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 */
class Utilisateur implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entreprise", inversedBy="utilisateurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Entreprise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email;

    /**
     * @ORM\Column(type="integer")
     */
    private $Telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nci;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Transaction", mappedBy="UserEmetteur")
     */
    private $envois;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Transaction", mappedBy="UserRecepteur")
     */
    private $retraits;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Profil", inversedBy="utilisateurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Profil;

    public function __construct()
    {
        $this->envois = new ArrayCollection();
        $this->retraits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->Entreprise;
    }

    public function setEntreprise(?Entreprise $Entreprise): self
    {
        $this->Entreprise = $Entreprise;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->Telephone;
    }

    public function setTelephone(int $Telephone): self
    {
        $this->Telephone = $Telephone;

        return $this;
    }

    public function getNci(): ?string
    {
        return $this->Nci;
    }

    public function setNci(string $Nci): self
    {
        $this->Nci = $Nci;

        return $this;
    }

    /**
     * @return Collection|Transaction[]
     */
    public function getEnvois(): Collection
    {
        return $this->envois;
    }

    public function addEnvois(Transaction $envois): self
    {
        if (!$this->envois->contains($envois)) {
            $this->envois[] = $envois;
            $envois->setUserEmetteur($this);
        }

        return $this;
    }

    public function removeEnvois(Transaction $envois): self
    {
        if ($this->envois->contains($envois)) {
            $this->envois->removeElement($envois);
            // set the owning side to null (unless already changed)
            if ($envois->getUserEmetteur() === $this) {
                $envois->setUserEmetteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Transaction[]
     */
    public function getRetraits(): Collection
    {
        return $this->retraits;
    }

    public function addRetrait(Transaction $retrait): self
    {
        if (!$this->retraits->contains($retrait)) {
            $this->retraits[] = $retrait;
            $retrait->setUserRecepteur($this);
        }

        return $this;
    }

    public function removeRetrait(Transaction $retrait): self
    {
        if ($this->retraits->contains($retrait)) {
            $this->retraits->removeElement($retrait);
            // set the owning side to null (unless already changed)
            if ($retrait->getUserRecepteur() === $this) {
                $retrait->setUserRecepteur(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(string $Status): self
    {
        $this->Status = $Status;

        return $this;
    }

    public function getProfil(): ?Profil
    {
        return $this->Profil;
    }

    public function setProfil(?Profil $Profil): self
    {
        $this->Profil = $Profil;

        return $this;
    }
}
