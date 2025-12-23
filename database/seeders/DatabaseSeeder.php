<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test Customer',
            'email' => 'customer@example.com',
        ]);

        User::factory()->create([
            'name' => 'Wholesale Customer',
            'email' => 'wholesale@example.com',
            'role' => UserRole::WholesaleCustomer
        ]);

        ProductCategory::factory()
            ->hasProducts(5)
            ->create();

        ProductCategory::factory()
            ->percentageDiscounted()
            ->hasProducts(5)
            ->create();

        ProductCategory::factory()
            ->fixedValueDiscounted()
            ->hasProducts(5)
            ->create();
    }
}
