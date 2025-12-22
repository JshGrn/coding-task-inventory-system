<?php

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;

test('product is discounted by 5 pounds for customer', function () {
    /** @var ProductCategory $productCategory */
    $productCategory = ProductCategory::factory()
        ->fixedValueDiscounted(500)
        ->create();

    /** @var Product $product */
    $product = Product::factory()->create([
        'product_category_id' => $productCategory->getKey(),
        'price' => 12500,
    ]);

    $calculatedPrice = new \App\PricingEngine\Calculator()->calculateForProduct(
        product: $product,
        productCategory: $productCategory,
        user: User::factory()->create()
    );

    expect($calculatedPrice)->toBe(12000);
});

test('product is discounted by 5 pounds and 20 percent for wholesale customer', function () {
    /** @var ProductCategory $productCategory */
    $productCategory = ProductCategory::factory()
        ->fixedValueDiscounted(500)
        ->create();

    /** @var Product $product */
    $product = Product::factory()->create([
        'product_category_id' => $productCategory->getKey(),
        'price' => 12500,
    ]);

    $calculatedPrice = new \App\PricingEngine\Calculator()->calculateForProduct(
        product: $product,
        productCategory: $productCategory,
        user: User::factory()->isWholesale()->create()
    );

    expect($calculatedPrice)->toBe(9600);
});

test('product is discounted by 20 percent for wholesale customer', function () {
    /** @var ProductCategory $productCategory */
    $productCategory = ProductCategory::factory()
        ->create();

    /** @var Product $product */
    $product = Product::factory()->create([
        'product_category_id' => $productCategory->getKey(),
        'price' => 20000,
    ]);

    $calculatedPrice = new \App\PricingEngine\Calculator()->calculateForProduct(
        product: $product,
        productCategory: $productCategory,
        user: User::factory()->isWholesale()->create()
    );

    expect($calculatedPrice)->toBe(16000);
});
