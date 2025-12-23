<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'title' => sprintf('Product %s', $this->faker->unique()->words(3, true)),
            'description' => $this->faker->optional()->paragraph(),
            'price' => $this->faker->numberBetween(2000, 10000),
            'product_category_id' => Product::factory()
        ];
    }
}
