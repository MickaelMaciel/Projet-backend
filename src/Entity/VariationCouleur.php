<?php

namespace App\Entity;

use App\Repository\VariationCouleurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VariationCouleurRepository::class)
 */
class VariationCouleur
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
    private $variationCouleurName;

    /**
     * @ORM\OneToMany(targetEntity=ArticleSimple::class, mappedBy="variationCouleur")
     */
    private $articleSimples;

    public function __construct()
    {
        $this->articleSimples = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVariationCouleurName(): ?string
    {
        return $this->variationCouleurName;
    }

    public function setVariationCouleurName(string $variationCouleurName): self
    {
        $this->variationCouleurName = $variationCouleurName;

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
            $articleSimple->setVariationCouleur($this);
        }

        return $this;
    }

    public function removeArticleSimple(ArticleSimple $articleSimple): self
    {
        if ($this->articleSimples->removeElement($articleSimple)) {
            // set the owning side to null (unless already changed)
            if ($articleSimple->getVariationCouleur() === $this) {
                $articleSimple->setVariationCouleur(null);
            }
        }

        return $this;
    }
}
