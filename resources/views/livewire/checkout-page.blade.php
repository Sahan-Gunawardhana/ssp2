<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="mb-4 text-2xl font-bold text-gray-800">Checkout</h1>
    <div class="grid grid-cols-12 gap-4">
      <div class="col-span-12 lg:col-span-8">
        <!-- Card -->
        <div class="p-6 bg-white rounded-lg shadow-md">
          <!-- Shipping Address -->
          <h2 class="mb-3 text-xl font-bold text-gray-700 underline">Shipping Address</h2>
          <div class="grid grid-cols-2 gap-4">
            <!-- Zip Code -->
            <div>
              <label class="block mb-1 text-gray-700" for="zip">ZIP Code</label>
              <input class="w-full px-3 py-2 border rounded-lg" id="zip" type="text" required pattern="\d{5}" title="ZIP Code must be 5 digits">
            </div>
        
            <!-- Province -->
            <div>
              <label class="block mb-1 text-gray-700" for="province">Province</label>
              <input class="w-full px-3 py-2 border rounded-lg" id="province" type="text" required minlength="3" title="Province name must be at least 3 characters">
            </div>
          </div>
        
          <div class="mt-4">
            <!-- City -->
            <label class="block mb-1 text-gray-700" for="city">City</label>
            <input class="w-full px-3 py-2 border rounded-lg" id="city" type="text" required minlength="3" title="City name must be at least 3 characters">
          </div>
        
          <div class="mt-4">
            <!-- Street -->
            <label class="block mb-1 text-gray-700" for="street">Street</label>
            <input class="w-full px-3 py-2 border rounded-lg" id="street" type="text" required minlength="3" title="Street name must be at least 3 characters">
          </div>
        
          <!-- Hidden Customer ID -->
          <input type="hidden" id="customerId" value="{{ auth()->check() ? auth()->id() : '' }}">
        
        
        </div>
        <!-- End Card -->
      </div>
  
      <!-- Order Summary -->
      <div class="col-span-12 lg:col-span-4">
        <div class="p-6 bg-white rounded-lg shadow-md">
          <h2 class="mb-3 text-xl font-bold text-gray-700 underline">ORDER SUMMARY</h2>
          <div class="flex justify-between mb-2 font-semibold">
            <span>Subtotal</span>
            <span>${{ number_format($ttl, 2) }}</span>
          </div>
          
          <div class="flex justify-between mb-2 font-semibold">
            <span>Shipping Cost</span>
            <span>FREE</span>
          </div>
          <hr class="my-4">
          <div class="flex justify-between text-lg font-bold">
            <span>Total</span>
            <span id="ttl">${{ number_format($ttl, 2) }}</span>
          </div>
        </div>
  
        <button id="placeOrderBtn" wire:click='clearCart' class="w-full p-3 mt-4 text-lg text-white bg-green-500 rounded-lg hover:bg-green-600">
          Place Order
        </button>
        <button id="placeBoxBtn" wire:click='clearCart' class="w-full p-3 mt-4 text-lg text-white bg-green-700 rounded-lg hover:bg-green-800">
          Create a Subscription Box
        </button>
  
        <!-- Basket Summary -->
        <div class="p-6 mt-4 bg-white rounded-lg shadow-md">
          <h2 class="mb-3 text-xl font-bold text-gray-700 underline">BASKET SUMMARY</h2>
          <ul class="divide-y divide-gray-300">
            @foreach ($cart_items as $item)
            <li class="flex items-center py-3">
              <img src="{{ $item['pro_image_url'] ? url($item['pro_image_url']) : asset('default-image.jpg') }}" alt="{{ $item['pro_name'] }}" class="object-cover w-full h-40 rounded-md">
              <div class="flex-1 ml-4">
                  <p class="text-sm font-medium text-gray-900">{{ $item['pro_name'] }}</p>
                  <p class="text-sm text-gray-500">Quantity: {{ $item['quantity'] }}</p>
              </div>
              <div class="text-base font-semibold text-gray-900">${{ number_format($item['pro_price'] * $item['quantity'], 2) }}</div>
          </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
  
  <script>
    document.getElementById("placeOrderBtn").addEventListener("click", async function () {
    const authToken = localStorage.getItem("authToken"); // Get token
    const customerId = document.getElementById("customerId").value;
    if (!authToken) {
        alert("You need to be logged in to place an order.");
        return;
    }

    // Get order details from the page
    const orderDate = new Date().toISOString().split("T")[0]; // Today's date
    const total = @json($ttl + $taxes);

    // Get address details from the form inputs
    const zipCode = document.getElementById("zip").value;
    const province = document.getElementById("province").value;
    const city = document.getElementById("city").value;
    const street = document.getElementById("street").value;
    const status = "pending";

    // Get cart items from Blade (convert to JS array)
    const cartItems = @json($cart_items).map(item => ({
    product_id: item.product_id,
    quantity: item.quantity,
    total: item.pro_price * item.quantity
}));

try {
        const response = await axios.post("http://127.0.0.1:8000/api/orders", {
            customer_id: customerId,
            order_date: orderDate,
            zip_code: zipCode,
            province: province,
            city: city,
            street: street,
            total: total,
            status: 'pending', // Set default status to pending
            items: cartItems
        }, {
            headers: { Authorization: `Bearer ${authToken}` } // Attach token
        });
        const orderDetails = `
          <strong>Order Date:</strong> ${orderDate} <br>
          <strong>Total:</strong> $${total} <br>
          <strong>Status:</strong> ${'pending'} <br>
        `;


        // Trigger SweetAlert with success message and redirect
        Swal.fire({
            title: 'Success!',
            html: `
            Your order has been placed successfully. Thank You<br><br>
            <div style="font-size: 14px; color: #666;">Your order will be delivered to you within 4 to 5 business days</div><br>
            ${orderDetails}
        `,
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            // Redirect to the home page after the alert
            window.location.href = '/';
        });
    } catch (error) {
        console.error("Order failed:", error.response?.data || error.message);
        alert("Failed to place order. Please try again.");
    }
});

  document.getElementById("placeBoxBtn").addEventListener("click", async function () {
      const authToken = localStorage.getItem("authToken"); // Get token
      const customerId = document.getElementById("customerId").value;
      if (!authToken) {
          alert("You need to be logged in to place a box.");
          return;
      }

      // Get order details from the page
      const orderDate = new Date().toISOString().split("T")[0]; // Today's date
      const total = @json($ttl + $taxes);

      // Get address details from the form inputs
      const zipCode = document.getElementById("zip").value;
      const province = document.getElementById("province").value;
      const city = document.getElementById("city").value;
      const street = document.getElementById("street").value;
      const status = 1;
      const subType = 'monthly';

      // Get cart items from Blade (convert to JS array)
      const cartItems = @json($cart_items).map(item => ({
      product_id: item.product_id,
      quantity: item.quantity,
      total: item.pro_price * item.quantity
  }));

  try {
          const response = await axios.post("http://127.0.0.1:8000/api/boxes", {
              customer_id: customerId,
              subscription_type: subType,
              zip_code: zipCode,
              province: province,
              city: city,
              street: street,
              price: total,
              status: status, // Set default status to pending
              items: cartItems
          }, {
              headers: { Authorization: `Bearer ${authToken}` } // Attach token
          });

          // Trigger SweetAlert with success message and redirect
          Swal.fire({
              title: 'Success!',
              text: 'Your subscription has been created successfully.',
              icon: 'success',
              confirmButtonText: 'OK'
          }).then(() => {
              // Redirect to the home page after the alert
              window.location.href = '/';
          });
      } catch (error) {
          console.error("Order failed:", error.response?.data || error.message);
          alert("Failed to place order. Please try again.");
      }
  });

  

  </script>