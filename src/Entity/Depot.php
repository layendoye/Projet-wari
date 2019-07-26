<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\DepotRepository")
 */
class Depot
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entreprise", inversedBy="depots")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Entreprise;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date;

    /**
     * @ORM\Column(type="bigint")
     */
    private $Montant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="depots")
     * @ORM\JoinColumn(nullable=false)
     */
    private $caissier;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->Montant;
    }

    public function setMontant(int $Montant): self
    {
        $this->Montant = $Montant;

        return $this;
    }

    public function getCaissier(): ?Utilisateur
    {
        return $this->caissier;
    }

    public function setCaissier(?Utilisateur $caissier): self
    {
        $this->caissier = $caissier;

        return $this;
    }
}
