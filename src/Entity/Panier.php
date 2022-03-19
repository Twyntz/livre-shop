<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PanierRepository::class)
 */
class Panier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="boolean")
     */
    private $acheter;

    /**
     * @ORM\ManyToOne(targetEntity=Book::class, inversedBy="paniers")
     */
    private $produit;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="paniers")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getAcheter(): ?bool
    {
        return $this->acheter;
    }

    public function setAcheter(bool $acheter): self
    {
        $this->acheter = $acheter;

        return $this;
    }

    public function getProduit(): ?Book
    {
        return $this->produit;
    }

    public function setProduit(?Book $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
