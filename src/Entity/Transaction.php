<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\TransactionRepository")
 */
class Transaction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ClientEmetteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $TelephoneEmetteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NciEmetteur;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateEnvoi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Code;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="envois")
     * @ORM\JoinColumn(nullable=false)
     */
    private $UserEmetteur;

    /**
     * @ORM\Column(type="bigint")
     */
    private $Montant;

    /**
     * @ORM\Column(type="bigint")
     */
    private $Frais;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ClientRecepteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $TelephoneRecepteur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $NciRecepteur;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $DateReception;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="retraits")
     */
    private $UserRecepteur;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $CommissionEmetteur;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $CommissionRecepteur;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $CommissionWari;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $TaxesEtat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClientEmetteur(): ?string
    {
        return $this->ClientEmetteur;
    }

    public function setClientEmetteur(string $ClientEmetteur): self
    {
        $this->ClientEmetteur = $ClientEmetteur;

        return $this;
    }

    public function getTelephoneEmetteur(): ?string
    {
        return $this->TelephoneEmetteur;
    }

    public function setTelephoneEmetteur(string $TelephoneEmetteur): self
    {
        $this->TelephoneEmetteur = $TelephoneEmetteur;

        return $this;
    }

    public function getNciEmetteur(): ?string
    {
        return $this->NciEmetteur;
    }

    public function setNciEmetteur(string $NciEmetteur): self
    {
        $this->NciEmetteur = $NciEmetteur;

        return $this;
    }

    public function getDateEnvoi(): ?\DateTimeInterface
    {
        return $this->DateEnvoi;
    }

    public function setDateEnvoi(\DateTimeInterface $DateEnvoi): self
    {
        $this->DateEnvoi = $DateEnvoi;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->Code;
    }

    public function setCode(string $Code): self
    {
        $this->Code = $Code;

        return $this;
    }

    public function getUserEmetteur(): ?Utilisateur
    {
        return $this->UserEmetteur;
    }

    public function setUserEmetteur(?Utilisateur $UserEmetteur): self
    {
        $this->UserEmetteur = $UserEmetteur;

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

    public function getFrais(): ?int
    {
        return $this->Frais;
    }

    public function setFrais(int $Frais): self
    {
        $this->Frais = $Frais;

        return $this;
    }

    public function getClientRecepteur(): ?string
    {
        return $this->ClientRecepteur;
    }

    public function setClientRecepteur(string $ClientRecepteur): self
    {
        $this->ClientRecepteur = $ClientRecepteur;

        return $this;
    }

    public function getTelephoneRecepteur(): ?string
    {
        return $this->TelephoneRecepteur;
    }

    public function setTelephoneRecepteur(string $TelephoneRecepteur): self
    {
        $this->TelephoneRecepteur = $TelephoneRecepteur;

        return $this;
    }

    public function getNciRecepteur(): ?string
    {
        return $this->NciRecepteur;
    }

    public function setNciRecepteur(?string $NciRecepteur): self
    {
        $this->NciRecepteur = $NciRecepteur;

        return $this;
    }

    public function getDateReception(): ?\DateTimeInterface
    {
        return $this->DateReception;
    }

    public function setDateReception(?\DateTimeInterface $DateReception): self
    {
        $this->DateReception = $DateReception;

        return $this;
    }

    public function getUserRecepteur(): ?Utilisateur
    {
        return $this->UserRecepteur;
    }

    public function setUserRecepteur(?Utilisateur $UserRecepteur): self
    {
        $this->UserRecepteur = $UserRecepteur;

        return $this;
    }

    public function getCommissionEmetteur(): ?int
    {
        return $this->CommissionEmetteur;
    }

    public function setCommissionEmetteur(?int $CommissionEmetteur): self
    {
        $this->CommissionEmetteur = $CommissionEmetteur;

        return $this;
    }

    public function getCommissionRecepteur(): ?int
    {
        return $this->CommissionRecepteur;
    }

    public function setCommissionRecepteur(?int $CommissionRecepteur): self
    {
        $this->CommissionRecepteur = $CommissionRecepteur;

        return $this;
    }

    public function getCommissionWari(): ?int
    {
        return $this->CommissionWari;
    }

    public function setCommissionWari(?int $CommissionWari): self
    {
        $this->CommissionWari = $CommissionWari;

        return $this;
    }

    public function getTaxesEtat(): ?int
    {
        return $this->TaxesEtat;
    }

    public function setTaxesEtat(?int $TaxesEtat): self
    {
        $this->TaxesEtat = $TaxesEtat;

        return $this;
    }
}
