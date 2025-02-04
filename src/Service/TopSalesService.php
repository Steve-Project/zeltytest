<?php

namespace App\Service;

use App\Repository\ProductRepositoryInterface;

readonly class TopSalesService
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    )
    {
    }

    public function getTopTenSales(): ?array
    {
        return $this->productRepository->findTopTenSales();
    }
}