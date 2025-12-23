<?php

namespace App\PricingEngine\Services;

use App\Models\Product;
use App\Models\User;
use App\PricingEngine\Contracts\DiscountCalculatorInterface;
use App\PricingEngine\Data\CalculatedProduct;
use Illuminate\Support\Collection;

class CalculatorService
{
    private Collection $discountCalculators;

    public function __construct(
        DiscountCalculatorInterface ...$discountCalculators
    ) {
        $this->discountCalculators = collect($discountCalculators);
    }

    public function calculateForProduct(
        Product $product,
        ?User $user
    ): CalculatedProduct {
        /**
         * Iterate over each calculator and apply discounts in
         * order starting with the product base price
         */
        return new CalculatedProduct(
            product: $product,
            calculatedPrice: (int)$this->discountCalculators->reduce(
                fn(int $currentPrice, DiscountCalculatorInterface $calculator) => $calculator->apply(
                    currentPrice: $currentPrice,
                    product: $product,
                    user: $user
                ),
                $product->price
            )
        );
    }

    public function calculateForProducts(
        Collection $products,
        ?User $user = null,
    ): Collection {
        return $products->map(
            fn(Product $product) => $this->calculateForProduct(
                product: $product,
                user: $user
            )
        );
    }
}
