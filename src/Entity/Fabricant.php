<?php

namespace App\Entity;

use App\Repository\FabricantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FabricantRepository::class)
 */
class Fabricant
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
     * @ORM\Column(type="text")
     */
    private $fabricantDescription;

    /**
     * @ORM\OneToMany(targetEntity=ProduitConfigurable::class, mappedBy="fabricant")
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

    public function getFabricantDescription(): ?string
    {
        return $this->fabricantDescription;
    }

    public function setFabricantDescription(string $fabricantDescription): self
    {
        $this->fabricantDescription = $fabricantDescription;

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
            $produitConfigurable->setFabricant($this);
        }

        return $this;
    }

    public function removeProduitConfigurable(ProduitConfigurable $produitConfigurable): self
    {
        if ($this->produitConfigurable->removeElement($produitConfigurable)) {
            // set the owning side to null (unless already changed)
            if ($produitConfigurable->getFabricant() === $this) {
                $produitConfigurable->setFabricant(null);
            }
        }

        return $this;
    }
}
