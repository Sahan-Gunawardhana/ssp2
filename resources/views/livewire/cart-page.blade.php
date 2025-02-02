<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="container px-4 mx-auto">
      <h1 class="mb-4 text-2xl font-semibold">Shopping Cart</h1>
      <div class="flex flex-col gap-4 md:flex-row">
        <div class="md:w-3/4">
          <div class="p-6 mb-4 overflow-x-auto bg-white rounded-lg">
            <table class="w-full border-collapse">
              <thead>
                  <tr class="border-b bg-white-100">
                      <th class="p-3 font-semibold text-left">Product</th>
                      <th class="p-3 font-semibold text-left">Price</th>
                      <th class="p-3 font-semibold text-center">Quantity</th>
                      <th class="p-3 font-semibold text-left">Total</th>
                  </tr>
              </thead>
              <tbody>
                  @forelse ($cart_items as $item)
                      <tr class="border-b hover:bg-gray-50">
                          <td class="p-4">
                              <div class="flex items-center space-x-4">
                                  <img src="{{ $item['pro_image_url'] ? url($item['pro_image_url']) : asset('default-image.jpg') }}" 
                                      alt="{{ $item['pro_name'] }}" 
                                      class="object-cover w-16 h-16 rounded-md shadow-sm">
                                  <span class="font-medium text-gray-800">{{ $item['pro_name'] }}</span>
                              </div>
                          </td>
                          <td class="p-4 text-gray-600">${{ number_format($item['pro_price'], 2) }}</td>
                          <td class="p-4 text-center">
                              <div class="flex items-center justify-center space-x-2">
                                  <button wire:click="decreaseQty({{ $item['product_id'] }})" 
                                      class="px-3 py-1 text-gray-600 border rounded-lg hover:bg-gray-200">−</button>
                                  <span class="w-8 font-semibold text-center">{{ $item['quantity'] }}</span>
                                  <button wire:click="increaseQty({{ $item['product_id'] }})" 
                                      class="px-3 py-1 text-gray-600 border rounded-lg hover:bg-gray-200">+</button>
                              </div>
                          </td>
                          <td class="p-4 font-semibold text-gray-800">${{ number_format($item['total_amount'], 2) }}</td>
                          <td class="p-4 text-center">
                              <button wire:click="removeItem({{ $item['product_id'] }})" 
                                  class="px-3 py-1 text-white bg-red-500 rounded-lg hover:bg-red-600">
                                  ✖
                              </button>
                          </td>
                      </tr>
                  @empty
                      <tr>
                          <td colspan="5" class="p-6 text-center text-gray-500">Your cart is empty</td>
                      </tr>
                  @endforelse
              </tbody>
          </table>
          </div>
        </div>
        <div class="md:w-1/4">
          <div class="p-6 bg-white rounded-lg ">
              <h2 class="mb-4 text-lg font-semibold">Summary</h2>
              
              <!-- Subtotal (you can dynamically set this if needed) -->
              <div class="flex justify-between mb-2">
                  <span>Subtotal</span>
                  <span>${{ number_format($ttl, 2) }}</span>
              </div>
              
              <!-- Taxes (if applicable, add similar logic) -->
              <div class="flex justify-between mb-2">
                  <span>Taxes</span>
                  <span>${{ number_format($ttl * 0.0, 2) }}</span> <!-- example, change logic if necessary -->
              </div>
              
              <!-- Shipping (you can replace this logic as needed) -->
              <div class="flex justify-between mb-2">
                  <span>Shipping</span>
                  <span>$0.00</span>
              </div>
              
              <hr class="my-2">
              
              <!-- Total -->
              <div class="flex justify-between mb-2">
                  <span class="font-semibold">Total</span>
                  <span class="font-semibold">${{ number_format($ttl + ($ttl * 0.0), 2) }}</span> <!-- Subtotal + taxes -->
              </div>
              
              <div class="space-y-4">
                <button wire:navigate 
                  onclick="window.location.href='{{ route('checkout') }}'" 
                  class="w-full fixed-button 
                  {{ count($cart_items) === 0 ? 'opacity-50 cursor-not-allowed' : '' }}" 
                  wire:loading.attr="disabled" 
                  wire:target="updateCart" 
                  @disabled(count($cart_items) === 0)>
                  Checkout
              </button>
          </div>
      </div>
      </div>
    </div>
  </div>