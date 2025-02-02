<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <section class="overflow-hidden bg-white py-11 font-poppins dark:bg-gray-800">
    <div class="max-w-6xl px-4 py-4 mx-auto lg:py-8 md:px-6">
      <div class="flex flex-wrap -mx-4">
        <div class="w-full mb-8 md:w-1/2 md:mb-0" x-data="{ mainImage: '{{ $product->pro_image_url }}' }">
          <div class="sticky top-0 z-50 overflow-hidden ">
            <div class="relative mb-6 lg:mb-10 lg:h-2/4 ">
              <img x-bind:src="mainImage" alt="{{ $product->pro_name }}" class="object-cover w-full lg:h-full ">
            </div>
            <div class="px-6 pb-6 mt-6 border-t border-gray-300 dark:border-gray-400 ">
            </div>
          </div>
        </div>
        <div class="w-full px-4 md:w-1/2 ">
          <div class="lg:pl-20">
            <div class="mb-8 ">
              <h2 class="max-w-xl mb-6 text-2xl font-bold dark:text-gray-400 md:text-4xl">
                {{ $product->pro_name }}</h2>
              <p class="inline-block mb-6 text-4xl font-bold text-gray-700 dark:text-gray-400 ">
                <span>${{ number_format($product->pro_price, 2) }}</span>
                @if ($product->pro_old_price)
                  <span class="text-base font-normal text-gray-500 line-through dark:text-gray-400">${{ number_format($product->pro_old_price, 2) }}</span>
                @endif
              </p>
              <p class="max-w-md text-gray-700 dark:text-gray-400">
                {{ $product->pro_description }}
              </p>
            </div>
            <div class="w-32 mb-8 ">
              <label for="" class="w-full pb-1 text-xl font-semibold text-gray-700 border-b border-green-300 dark:border-gray-600 dark:text-gray-400">Quantity</label>
              <div class="relative flex flex-row w-full h-10 mt-6 bg-transparent rounded-lg">
                <button wire:click='decreaseQ' class="w-20 h-full text-gray-600 bg-gray-300 rounded-l outline-none cursor-pointer dark:hover:bg-gray-700 dark:text-gray-400 hover:text-gray-700 dark:bg-gray-900 hover:bg-gray-400">
                  <span class="m-auto text-2xl font-thin">-</span>
                </button>
                <input type="number" wire:model='quantity' readonly class="flex items-center w-full font-semibold text-center text-gray-700 placeholder-gray-700 bg-gray-300 outline-none dark:text-gray-400 dark:placeholder-gray-400 dark:bg-gray-900 focus:outline-none text-md hover:text-black" placeholder="1">
                <button wire:click='increaseQ' class="w-20 h-full text-gray-600 bg-gray-300 rounded-r outline-none cursor-pointer dark:hover:bg-gray-700 dark:text-gray-400 dark:bg-gray-900 hover:text-gray-700 hover:bg-gray-400">
                  <span class="m-auto text-2xl font-thin">+</span>
                </button>
              </div>
            </div>
            <button wire:click="addToCart({{ $product->id }})" class="w-full p-4 text-white bg-green-500 rounded-md lg:w-2/5 hover:bg-green-600 dark:bg-blue-500 dark:hover:bg-blue-700 dark:text-white">
              <span wire:loading.remove wire:target="addToCart">Add to cart</span>
              <span wire:loading.delay wire:target="addToCart">Adding...</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>