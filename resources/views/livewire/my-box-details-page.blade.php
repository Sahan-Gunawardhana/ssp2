<div class="container p-6 mx-auto">
    <h2 class="mb-4 text-2xl font-bold text-gray-800">Subscription #{{ $box->id }} Details</h2>

    <!-- Order Information -->
    <div class="mb-6">
        <p><strong>Status:</strong> {{ ucfirst($box->status) }}</p>
        <p><strong>Total:</strong> ${{ number_format($box->total, 2) }}</p>
        <p><strong>Created At:</strong> {{ $box->created_at->format('M d, Y') }}</p>
    </div>

    <!-- Order Items -->
    <h3 class="mb-4 text-xl font-semibold text-gray-800">Box Items</h3>
    <div class="space-y-4">
        @foreach ($box->boxItems as $boxItem)
            <div class="p-4 bg-white border border-gray-300 rounded-lg shadow-md">
                <span class="block text-lg font-semibold text-gray-800">{{ $boxItem->product->pro_name }}</span> <!-- Product name -->
                <span class="block text-gray-600">Quantity: {{ $boxItem->quantity }}</span>
                <span class="block text-gray-600">Price: ${{ number_format($boxItem->product->pro_price, 2) }}</span> <!-- Product price -->
            </div>
        @endforeach
    </div>
</div>