<?php

namespace App\Trait;

trait DiscountTrait
{
    public function calculateDiscount(int $amount, ?float $discount): float
    {
        $discount = $discount ?? 10;
        if ($discount < 0) {
            $discount = 0;
        } elseif ($discount > 100) {
            $discount = 100;
        }

        return $amount - ($amount * ($discount / 100));
    }
}