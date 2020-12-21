<?php

namespace App\Entity;

use App\Repository\ArticleSimpleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleSimpleRepository::class)
 */
class ArticleSimple
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
    private $articleSimpleName;

    /**
     * @ORM\Column(type="float")
     */
    private $articleSimplePrixAchat;

    /**
     * @ORM\Column(type="float")
     */
    private $articleSimplePrixVente;

    /**
     * @ORM\ManyToOne(targetEntity=ProduitConfigurable::class, inversedBy="articleSimples")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produitConfigurable;

    /**
     * @ORM\ManyToOne(targetEntity=VariationCouleur::class, inversedBy="articleSimples")
     */
    private $variationCouleur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticleSimpleName(): ?string
    {
        return $this->articleSimpleName;
    }

    public function setArticleSimpleName(string $articleSimpleName): self
    {
        $this->articleSimpleName = $articleSimpleName;

        return $this;
    }

    public function getArticleSimplePrixAchat(): ?float
    {
        return $this->articleSimplePrixAchat;
    }

    public function setArticleSimplePrixAchat(float $articleSimplePrixAchat): self
    {
        $this->articleSimplePrixAchat = $articleSimplePrixAchat;

        return $this;
    }

    public function getArticleSimplePrixVente(): ?float
    {
        return $this->articleSimplePrixVente;
    }

    public function setArticleSimplePrixVente(float $articleSimplePrixVente): self
    {
        $this->articleSimplePrixVente = $articleSimplePrixVente;

        return $this;
    }

    public function getProduitConfigurable(): ?ProduitConfigurable
    {
        return $this->produitConfigurable;
    }

    public function setProduitConfigurable(?ProduitConfigurable $produitConfigurable): self
    {
        $this->produitConfigurable = $produitConfigurable;

        return $this;
    }

    public function getVariationCouleur(): ?VariationCouleur
    {
        return $this->variationCouleur;
    }

    public function setVariationCouleur(?VariationCouleur $variationCouleur): self
    {
        $this->variationCouleur = $variationCouleur;

        return $this;
    }
}
