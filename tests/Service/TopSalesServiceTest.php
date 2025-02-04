<?php

namespace App\Tests\Service;

use App\Repository\ProductRepositoryInterface;
use App\Service\TopSalesService;
use PHPUnit\Framework\TestCase;

class TopSalesServiceTest extends TestCase
{
    private ProductRepositoryInterface $productRepositoryMock;
    private TopSalesService $topSalesService;

    protected function setUp(): void
    {
        $this->productRepositoryMock = $this->createMock(ProductRepositoryInterface::class);
        $this->topSalesService = new TopSalesService($this->productRepositoryMock);
    }
    public function topSalesDataProvider(): array
    {
        return [
            'original order' => [
                [
                    ['code' => 1, 'label' => 'Bouteille de coca cola', 'totalSales' => 100],
                    ['code' => 2, 'label' => 'Bouteille de fanta', 'totalSales' => 80],
                ]
            ],
            'reversed order' => [
                [
                    ['code' => 2, 'label' => 'Bouteille de fanta', 'totalSales' => 80],
                    ['code' => 1, 'label' => 'Bouteille de coca cola', 'totalSales' => 100],
                ]
            ]
        ];
    }

    /**
     * @dataProvider topSalesDataProvider
     */
    public function testApiGetProductListWithSales(array $expectedTopSales): void
    {
        $this->productRepositoryMock->method('findTopTenSales')->willReturn($expectedTopSales);
        $topSales = $this->topSalesService->getTopTenSales();

        $this->assertCount(2, $topSales);
        $this->assertEquals($expectedTopSales[0]['label'], $topSales[0]['label']);
        $this->assertEquals($expectedTopSales[0]['totalSales'], $topSales[0]['totalSales']);
    }

    public function testApiGetProductListWithoutSales(): void
    {
        $this->productRepositoryMock->method('findTopTenSales')->willReturn(null);
        $topSales = $this->topSalesService->getTopTenSales();
        $this->assertNull($topSales);
    }
}
