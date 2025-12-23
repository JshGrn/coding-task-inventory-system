<?php

namespace App\PricingEngine\Calculators;

use App\Enums\UserRole;
use App\Models\Product;
use App\Models\User;
use App\PricingEngine\Contracts\DiscountCalculatorInterface;
use App\PricingEngine\Repositories\UserDiscountPercentageRepository;

class UserCalculator implements DiscountCalculatorInterface
{
    public function __construct(
        protected UserDiscountPercentageRepository $userDiscountPercentageRepository
    ) {
    }

    public function apply(int $currentPrice, Product $product, ?User $user = null): int
    {
        $userDiscount = $this->userDiscountPercentageRepository->getDiscountPercentage($user);

        if ( ! $userDiscount) {
            return $currentPrice;
        }

        return max(
            0,
            $currentPrice - ($currentPrice * ($userDiscount / 100))
        );
    }
}
