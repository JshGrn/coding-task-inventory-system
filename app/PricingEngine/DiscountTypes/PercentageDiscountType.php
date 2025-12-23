<?php

namespace App\PricingEngine\DiscountTypes;

use App\PricingEngine\Contracts\DiscountTypeInterface;
use Brick\Money\Money;

class PercentageDiscountType implements DiscountTypeInterface
{
    public function modify(int $currentPrice, int $discountValue): int
    {
        return max(
            0,
            round($currentPrice - ($currentPrice * ($discountValue / 100)))
        );
    }
}
