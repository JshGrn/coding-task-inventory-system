<?php

namespace App\Providers;

use App\PricingEngine\Calculators\ProductCategoryCalculator;
use App\PricingEngine\Calculators\UserCalculator;
use App\PricingEngine\Repositories\UserDiscountPercentageRepository;
use App\PricingEngine\Services\Calculator;
use App\PricingEngine\Services\CalculatorService;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CalculatorService::class, function (Application $app) {
            return new CalculatorService(
                $app->make(ProductCategoryCalculator::class),
                $app->make(UserCalculator::class),
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ViewFacade::composer('*', function (View $view) {
            if (auth()->check()) {
                $view->with('userDiscount', app(UserDiscountPercentageRepository::class)->getDiscountPercentage(auth()->user()));
            }
        });
    }
}
