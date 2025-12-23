<?php

namespace Database\Factories;

use App\Enums\DiscountType;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCategoryFactory extends Factory
{
    protected $model = ProductCategory::class;

    public function definition(): array
    {
        return [
            'title' => sprintf('Category %s', $this->faker->unique()->words(2, true)),
        ];
    }

    public function percentageDiscounted(?int $percentageDiscount = null): ProductCategoryFactory
    {
        return $this->state(function (array $attributes) use ($percentageDiscount) {
            return [
                'title' => sprintf('Discounted %s', $attributes['title']),
                'discount_type' => DiscountType::Percentage,
                'discount_value' => $percentageDiscount ?? $this->faker->numberBetween(5, 25)
            ];
        });
    }

    public function fixedValueDiscounted(?int $minorValueDiscount = null): ProductCategoryFactory
    {
        return $this->state(function (array $attributes) use ($minorValueDiscount) {
            return [
                'title' => sprintf('Discounted %s', $attributes['title']),
                'discount_type' => DiscountType::FixedValue,
                'discount_value' => $minorValueDiscount ?? ($this->faker->numberBetween(5, 10) * 100)
            ];
        });
    }
}
