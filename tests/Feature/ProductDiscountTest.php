<?php

use App\Enums\DiscountType;
use App\Enums\UserRole;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use App\PricingEngine\Services\CalculatorService;

test('product category discounts apply correctly', function (
    DiscountType $discountType,
    int $discountValue,
    bool $isUserWholesale,
    int $productPrice,
    int $expectedPrice
) {
    /** @var ProductCategory $productCategory */
    $productCategory = ProductCategory::factory()
        ->create([
            'discount_value' => $discountValue,
            'discount_type' => $discountType,
        ]);

    /** @var Product $product */
    $product = Product::factory()->create([
        'product_category_id' => $productCategory->getKey(),
        'price' => $productPrice,
    ]);

    $calculatedPrice = app(CalculatorService::class)->calculateForProduct(
        product: $product,
        user: User::factory()->create([
            'role' => $isUserWholesale ? UserRole::WholesaleCustomer : UserRole::Customer,
        ])
    )->getCalculatedPrice();

    expect($calculatedPrice)->toBe($expectedPrice);
})->with([
    '10 percent discount standard customer' => [DiscountType::Percentage, 10, false, 20000, 18000],
    '50 percent discount standard customer' => [DiscountType::Percentage, 50, false, 10000, 5000],
    '25 percent discount wholesale customer' => [DiscountType::Percentage, 25, true, 20000, 12000],
    '5 pound discount standard customer' => [DiscountType::FixedValue, 500, false, 15000, 14500],
    '20 pound discount wholesale customer' => [DiscountType::FixedValue, 2000, true, 15000, 10400],
]);

test('wholesale customer discounts apply', function (
    int $productPrice,
    int $expectedPrice
) {
    /** @var ProductCategory $productCategory */
    $productCategory = ProductCategory::factory()
        ->create();

    /** @var Product $product */
    $product = Product::factory()->create([
        'product_category_id' => $productCategory->getKey(),
        'price' => $productPrice,
    ]);

    $calculatedPrice = app(CalculatorService::class)->calculateForProduct(
        product: $product,
        user: User::factory()->isWholesale()->create()
    )->getCalculatedPrice();

    expect($calculatedPrice)->toBe($expectedPrice);
})->with([
    [10000, 8000],
    [5000, 4000],
    [20000, 16000],
]);
