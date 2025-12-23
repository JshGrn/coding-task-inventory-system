<?php

namespace App\PricingEngine\Data;

use App\Models\Product;
use Brick\Money\Money;

readonly class CalculatedProduct
{
    public function __construct(
        public Product $product,
        public int $calculatedPrice
    ) {
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getCalculatedPrice(): int
    {
        return $this->calculatedPrice;
    }

    public function getFormattedBasePrice(): string
    {
        return Money::ofMinor($this->product->price, 'GBP')->formatTo('en_GB');
    }

    public function getFormattedCalculatedPrice(): string
    {
        return Money::ofMinor($this->calculatedPrice, 'GBP')->formatTo('en_GB');
    }
}
