<?php

namespace App\PricingEngine\Resolvers;

use App\Enums\DiscountType;
use App\PricingEngine\Contracts\DiscountTypeInterface;
use App\PricingEngine\DiscountTypes\FixedDiscountType;
use App\PricingEngine\DiscountTypes\PercentageDiscountType;

class DiscountTypeResolver
{
    public function __construct(
        public PercentageDiscountType $percentageDiscountType,
        public FixedDiscountType $fixedDiscountType,
    )
    {
    }

    public function resolve(DiscountType $discountType): DiscountTypeInterface
    {
        return match ($discountType) {
            DiscountType::Percentage => $this->percentageDiscountType,
            DiscountType::FixedValue => $this->fixedDiscountType
        };
    }
}
