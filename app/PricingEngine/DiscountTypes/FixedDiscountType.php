<?php

namespace App\PricingEngine\DiscountTypes;

use App\PricingEngine\Contracts\DiscountTypeInterface;

class FixedDiscountType implements DiscountTypeInterface
{
    public function modify(int $currentPrice, int $discountValue): int
    {
        return max(
            0,
            $currentPrice - $discountValue
        );
    }
}
