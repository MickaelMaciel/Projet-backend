<?php

namespace App\Entity;

use App\Repository\ProduitConfigurableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitConfigurableRepository::class)
 */
class ProduitConfigurable
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
     * @ORM\Column(type="datetime")
     */
    private $produitConfigurableCreationAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $produitConfigurableMajAt;

    /**
     * @ORM\ManyToOne(targetEntity=SousTypeProduit::class, inversedBy="produitConfigurable")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sousTypeProduit;

    /**
     * @ORM\ManyToOne(targetEntity=Fabricant::class, inversedBy="produitConfigurable")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fabricant;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="produitConfigurable")
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity=ArticleSimple::class, mappedBy="produitConfigurable")
     */
    private $articleSimples;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->articleSimples = new ArrayCollection();
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

    public function getProduitConfigurableCreationAt(): ?\DateTimeInterface
    {
        return $this->produitConfigurableCreationAt;
    }

    public function setProduitConfigurableCreationAt(\DateTimeInterface $produitConfigurableCreationAt): self
    {
        $this->produitConfigurableCreationAt = $produitConfigurableCreationAt;

        return $this;
    }

    public function getProduitConfigurableMajAt(): ?\DateTimeInterface
    {
        return $this->produitConfigurableMajAt;
    }

    public function setProduitConfigurableMajAt(\DateTimeInterface $produitConfigurableMajAt): self
    {
        $this->produitConfigurableMajAt = $produitConfigurableMajAt;

        return $this;
    }

    public function getSousTypeProduit(): ?SousTypeProduit
    {
        return $this->sousTypeProduit;
    }

    public function setSousTypeProduit(?SousTypeProduit $sousTypeProduit): self
    {
        $this->sousTypeProduit = $sousTypeProduit;

        return $this;
    }

    public function getFabricant(): ?Fabricant
    {
        return $this->fabricant;
    }

    public function setFabricant(?Fabricant $fabricant): self
    {
        $this->fabricant = $fabricant;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setProduitConfigurable($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getProduitConfigurable() === $this) {
                $image->setProduitConfigurable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ArticleSimple[]
     */
    public function getArticleSimples(): Collection
    {
        return $this->articleSimples;
    }

    public function addArticleSimple(ArticleSimple $articleSimple): self
    {
        if (!$this->articleSimples->contains($articleSimple)) {
            $this->articleSimples[] = $articleSimple;
            $articleSimple->setProduitConfigurable($this);
        }

        return $this;
    }

    public function removeArticleSimple(ArticleSimple $articleSimple): self
    {
        if ($this->articleSimples->removeElement($articleSimple)) {
            // set the owning side to null (unless already changed)
            if ($articleSimple->getProduitConfigurable() === $this) {
                $articleSimple->setProduitConfigurable(null);
            }
        }

        return $this;
    }

}
