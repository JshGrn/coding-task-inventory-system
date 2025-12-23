<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr>
            <th width="40%" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                Product
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                Category
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                Category Discount
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                RRP
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                Your Price
            </th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200 text-sm">
        @forelse($calculatedProducts as $calculatedProduct)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">
                    <div class="block mb-2 last:mb-0">
                        <a class="underline text-lg" href="{{route('products.view', ['product' => $calculatedProduct->product])}}">
                            {{ $calculatedProduct->product->title }}
                        </a>
                    </div>
                    @if($calculatedProduct->product->description)
                        <div class=" text-gray-500">
                            {{ $calculatedProduct->product->description }}
                        </div>
                    @endif
                </td>
                <td class="px-6 py-4">
                    {{ $calculatedProduct->product->productCategory->title }}
                </td>
                <td class="px-6 py-4">
                    {{ $calculatedProduct->product->productCategory->formatted_discount }}
                </td>
                <td class="px-6 py-4  text-gray-500">
                    {{$calculatedProduct->getFormattedBasePrice()}}
                </td>
                <td class="px-6 py-4">
                    {{$calculatedProduct->getFormattedCalculatedPrice()}}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                    <p class="text-lg">No products found</p>
                    <p class=" mt-1">Products will appear here once they are added.</p>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
