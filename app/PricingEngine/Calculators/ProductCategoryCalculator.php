<?php

namespace App\PricingEngine\Calculators;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use App\PricingEngine\Contracts\DiscountCalculatorInterface;
use App\PricingEngine\Data\PricingEngineResult;
use App\PricingEngine\Resolvers\DiscountTypeResolver;

class ProductCategoryCalculator implements DiscountCalculatorInterface
{
    public function __construct(
        private DiscountTypeResolver $discountTypeResolver
    ) {
    }

    public function apply(int $currentPrice, Product $product, ?User $user = null): int
    {
        /** @var ProductCategory $productCategory */
        $productCategory = $product->productCategory;

        if ($productCategory->hasValidDiscount() === false) {
            return $currentPrice;
        }

        $discountType = $this->discountTypeResolver->resolve($productCategory->discount_type);

        return $discountType->modify(
            currentPrice: $currentPrice,
            discountValue: $productCategory->discount_value
        );
    }
}
