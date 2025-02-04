<?php

namespace App\Repository;

interface ProductRepositoryInterface
{
    public function findTopTenSales(): ?array;
}