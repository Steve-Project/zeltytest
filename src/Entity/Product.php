<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use App\Trait\DiscountTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    use DiscountTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column]
    private ?int $price = null;

    /**
     * @var Collection<int, Line>
     */
    #[ORM\OneToMany(targetEntity: Line::class, mappedBy: 'product')]
    private Collection $productLines;

    #[ORM\Column]
    private ?bool $isActive = null;

    public function __construct()
    {
        $this->productLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, Line>
     */
    public function getProductLines(): Collection
    {
        return $this->productLines;
    }

    public function addProductLine(Line $productLine): static
    {
        if (!$this->productLines->contains($productLine)) {
            $this->productLines->add($productLine);
            $productLine->setProduct($this);
        }

        return $this;
    }

    public function removeProductLine(Line $productLine): static
    {
        if ($this->productLines->removeElement($productLine)) {
            // set the owning side to null (unless already changed)
            if ($productLine->getProduct() === $this) {
                $productLine->setProduct(null);
            }
        }

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getTotalSales(): int
    {
        $total = 0;
        foreach ($this->getProductLines() as $productLine)
        {
            $total += $productLine->getAmount() * $productLine->getQuantity();
        }
        return $total;
    }

    public function applyDiscount(?float $discount): float
    {
        return $this->calculateDiscount($this->getPrice(), $discount);
    }
}
