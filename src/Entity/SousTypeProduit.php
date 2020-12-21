<?php

namespace App\Entity;

use App\Repository\SousTypeProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SousTypeProduitRepository::class)
 */
class SousTypeProduit
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
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=TypeProduit::class, inversedBy="sousTypeProduit")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeProduit;

    /**
     * @ORM\OneToMany(targetEntity=ProduitConfigurable::class, mappedBy="sousTypeProduit")
     */
    private $produitConfigurable;

    public function __construct()
    {
        $this->produitConfigurable = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTypeProduit(): ?TypeProduit
    {
        return $this->typeProduit;
    }

    public function setTypeProduit(?TypeProduit $typeProduit): self
    {
        $this->typeProduit = $typeProduit;

        return $this;
    }

    /**
     * @return Collection|ProduitConfigurable[]
     */
    public function getProduitConfigurable(): Collection
    {
        return $this->produitConfigurable;
    }

    public function addProduitConfigurable(ProduitConfigurable $produitConfigurable): self
    {
        if (!$this->produitConfigurable->contains($produitConfigurable)) {
            $this->produitConfigurable[] = $produitConfigurable;
            $produitConfigurable->setSousTypeProduit($this);
        }

        return $this;
    }

    public function removeProduitConfigurable(ProduitConfigurable $produitConfigurable): self
    {
        if ($this->produitConfigurable->removeElement($produitConfigurable)) {
            // set the owning side to null (unless already changed)
            if ($produitConfigurable->getSousTypeProduit() === $this) {
                $produitConfigurable->setSousTypeProduit(null);
            }
        }

        return $this;
    }
}
