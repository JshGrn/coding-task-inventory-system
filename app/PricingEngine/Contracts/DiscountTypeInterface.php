<?php

namespace App\PricingEngine\Contracts;

interface DiscountTypeInterface
{
    public function modify(int $currentPrice, int $discountValue): int;
}
