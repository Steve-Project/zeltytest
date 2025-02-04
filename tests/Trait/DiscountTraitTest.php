<?php

namespace App\Tests\Trait;

use App\Trait\DiscountTrait;
use PHPUnit\Framework\TestCase;

class DiscountTraitTest extends TestCase
{
    use DiscountTrait;
    public function calculateDiscountProvider(): array
    {
        return [
            'discount null' => [null, 90],
            'discount 30%' => [30, 70],
            'discount 150%' => [150, 0],
            'discount -30%' => [-30, 100],
        ];
    }

    /**
     * @dataProvider calculateDiscountProvider
     */
    public function testCalculateDiscount(?float $discount, float $expectedAmount): void
    {
        $this->assertEquals($expectedAmount, $this->calculateDiscount(100, $discount));
    }
}
