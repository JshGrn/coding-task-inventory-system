<?php

namespace App\PricingEngine\Contracts;

use App\Models\Product;
use App\Models\User;

interface DiscountCalculatorInterface
{
    public function apply(int $currentPrice, Product $product, ?User $user = null): int;
}
