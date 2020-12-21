<?php

namespace App\Entity;

use App\Repository\TypeProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeProduitRepository::class)
 */
class TypeProduit
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
     * @ORM\OneToMany(targetEntity=SousTypeProduit::class, mappedBy="typeProduit")
     */
    private $sousTypeProduit;

    public function __construct()
    {
        $this->sousTypeProduit = new ArrayCollection();
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

    /**
     * @return Collection|SousTypeProduit[]
     */
    public function getSousTypeProduit(): Collection
    {
        return $this->sousTypeProduit;
    }

    public function addSousTypeProduit(SousTypeProduit $sousTypeProduit): self
    {
        if (!$this->sousTypeProduit->contains($sousTypeProduit)) {
            $this->sousTypeProduit[] = $sousTypeProduit;
            $sousTypeProduit->setTypeProduit($this);
        }

        return $this;
    }

    public function removeSousTypeProduit(SousTypeProduit $sousTypeProduit): self
    {
        if ($this->sousTypeProduit->removeElement($sousTypeProduit)) {
            // set the owning side to null (unless already changed)
            if ($sousTypeProduit->getTypeProduit() === $this) {
                $sousTypeProduit->setTypeProduit(null);
            }
        }

        return $this;
    }
}
