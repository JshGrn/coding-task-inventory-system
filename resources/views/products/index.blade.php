@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Products</h1>
        <p class="text-gray-500 mt-1">Browse our product catalog</p>
    </div>

    @foreach($calculatedProductsByCategories as $categoryTitle => $calculatedProducts)
        <div class="my-12">
            <h1 class="text-2xl mb-4">{{$categoryTitle}}</h1>
            @include('products.productCategory', ['calculatedProducts' => $calculatedProducts])
        </div>
    @endforeach
</div>
@endsection
