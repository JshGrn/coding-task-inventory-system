@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6 pb-6 border-b border-gray-300">
            <a href="{{route('products.index')}}" class="text-lg font-semibold underline">Back to Products</a>
        </div>
        <div class="grid grid-cols-2 gap-x-24">
            <div>
                <img src="https://picsum.photos/500/400" alt="{{$calculatedProduct->product->title}}" class="w-full h-auto rounded-lg shadow">
            </div>
            <div class="flex flex-col gap-2.5">
                <h1 class="text-2xl font-bold text-gray-800">{{$calculatedProduct->product->title}}</h1>

                @if($calculatedProduct->product->description)
                    <div>
                        {{$calculatedProduct->product->description}}
                    </div>
                @endif

                <div class="flex flex-col gap-1.5">
                    <span><span class="font-semibold">Category:</span> {{$calculatedProduct->product->productCategory->title}} ({{ $calculatedProduct->product->productCategory->formatted_discount }})</span>
                    @if($calculatedProduct->product->productCategory->hasValidDiscount())
                        <span><span class="font-semibold">RRP Price:</span> {{$calculatedProduct->getFormattedBasePrice()}}</span>
                    @endif
                    <span><span class="font-semibold">Your Price:</span> {{$calculatedProduct->getFormattedCalculatedPrice()}}</span>
                    @if($calculatedProduct->getCalculatedDiscount() > 0)
                        <span><span class="font-semibold">Discount:</span> {{$calculatedProduct->getFormattedDiscountPrice()}} ({{$calculatedProduct->getDiscountPercentage()}}%)</span>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
