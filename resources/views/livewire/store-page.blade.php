<div class="w-full px-4 py-10 mx-auto max-w sm:px-6 lg:px-8">
    <section class="py-10 rounded-lg bg-gray-50 font-poppins dark:bg-gray-800">
      <div class="px-4 py-4 mx-auto max-w lg:py-6 md:px-6">
        <div class="flex flex-wrap mb-24 -mx-3">
          <div class="w-full pr-2 lg:w-1/4 lg:block">
            <div class="p-4 mb-5 bg-white border border-gray-200 dark:border-gray-900 dark:bg-gray-900">
              <h2 class="text-2xl font-bold dark:text-gray-400">Categories</h2>
              <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
              <ul>
                @foreach(['Food', 'Toys', 'Bedding', 'Training', 'Clothes', 'Grooming', 'Health', 'Aquatic'] as $category)
                  <li class="mb-4">
                    <label for="" class="flex items-center dark:text-gray-400">
                      <input type="checkbox" wire:click="toggleCategory('{{ $category }}')" class="w-4 h-4 mr-2">
                      <span class="text-lg">{{ $category }}</span>
                    </label>
                  </li>
                @endforeach
              </ul>
            </div>
            <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
              <h2 class="text-2xl font-bold dark:text-gray-400">Price</h2>
              <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
              <div>
                <input type="range" wire:model.live="maxPrice"
                class="w-full h-1 mb-4 bg-blue-100 rounded appearance-none cursor-pointer"
                min="5" max="100" step="1">
                  <div class="flex justify-between">
                      <span class="inline-block text-lg font-bold text-blue-400">$5</span>
                      <span class="inline-block text-lg font-bold text-blue-400">${{ number_format($maxPrice) }}</span>
                  </div>
              </div>
            </div>
          </div>
          <div class="w-full px-3 lg:w-3/4">
            <div class="px-3 mb-4">
              <div class="items-center justify-between hidden px-3 py-2 bg-gray-100 md:flex dark:bg-gray-900 ">
                  <div class="mb-4">
                      <label for="sort" class="text-lg">Sort by:</label>
                      <select wire:model="sortBy" wire:change="$refresh" id="sort"
                        class="w-full p-2 mt-2 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-600">
                        <option value="latest">Latest</option>
                        <option value="price_high_to_low">Price: High to Low</option>
                    </select>
                  </div>
              </div>
          </div>
          <div class="flex flex-wrap items-center">
            <div class="container p-6 mx-auto">
                <h2 class="mb-6 text-2xl font-bold text-gray-800">Store</h2>
        
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @foreach($products as $product)
                        <a href="{{ route('product.show', ['productId' => $product->id]) }}" class="p-4 transition-transform transform border rounded-lg shadow-md hover:shadow-lg hover:scale-105">
                            <img src="{{ $product->pro_image_url }}" alt="{{ $product->pro_name }}" class="object-cover w-full h-40 rounded-md">
                            <h3 class="mt-2 text-lg font-semibold">{{ $product->pro_name }}</h3>
                            <p class="text-gray-600">${{ number_format($product->pro_price, 2) }}</p>
        
                            <!-- Add to Cart Button -->
                            <button wire:click.prevent="addToCart({{ $product->id }})" class="flex items-center px-4 py-2 mt-2 space-x-2 text-white bg-green-500 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 bi bi-cart3" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                                </svg>
                                <span wire:loading.remove wire:target='addToCart({{ $product->id }})'>Add to Cart</span>
                                <span wire:loading wire:target='addToCart({{ $product->id }})'>Adding...</span>
                            </button>
                        </a>
                    @endforeach
                </div>
                <!-- Pagination Links -->
                <div class="mt-6">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
          </div>
        </div>
      </div>
    </section>
      
    <div class="fixed bottom-0 left-0 right-0 flex justify-center p-4 space-x-4 bg-white shadow-md dark:bg-gray-800">
      @auth
          <!-- Authenticated user content can go here -->
      @else
          
          <a href="{{ route('login') }}" class="fixed-button">Log in</a>
          @if (Route::has('register'))
              <a href="{{ route('register') }}" class="fixed-button">Register</a>
          @endif
      @endauth
  </div>

  </div>