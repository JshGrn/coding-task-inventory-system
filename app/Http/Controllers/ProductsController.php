<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\PricingEngine\Data\CalculatedProduct;
use App\PricingEngine\Services\CalculatorService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(CalculatorService $calculatorService)
    {
        $products = Product::query()
            ->with('productCategory')
            ->get();

        $calculatedProducts = $calculatorService->calculateForProducts(
            products: $products,
            user: auth()->user(),
        );

        $calculatedProductsByCategories = $calculatedProducts->mapToGroups(
            fn(CalculatedProduct $calculatedProduct) => [
                $calculatedProduct->getProduct()->productCategory->title => $calculatedProduct,
            ]
        );

        return view('products.index', [
            'calculatedProductsByCategories' => $calculatedProductsByCategories,
        ]);
    }
}
