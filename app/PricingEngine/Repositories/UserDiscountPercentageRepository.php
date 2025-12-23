<?php

namespace App\PricingEngine\Repositories;

use App\Enums\UserRole;
use App\Models\User;

class UserDiscountPercentageRepository
{
    public function getDiscountPercentage(?User $user): ?int
    {
        return match ($user?->role) {
            UserRole::WholesaleCustomer => 20,
            default => 0,
        };
    }
}
