<div class="container p-6 mx-auto space-y-8">
    <!-- My Orders Section -->
    <h2 class="mb-4 text-2xl font-bold text-gray-800">My Orders</h2>
    
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($orders as $order)
            <div class="p-4 bg-white border border-gray-300 rounded-lg shadow-md">
                <div class="mb-4">
                    <span class="block text-lg font-semibold text-gray-800">Order ID: #{{ $order->id }}</span>
                    <span class="block text-gray-600">Total: ${{ number_format($order->total, 2) }}</span>
                    <span class="block text-gray-600">Status: {{ ucfirst($order->status) }}</span>
                    <span class="block text-gray-600">Created At: {{ $order->created_at->format('M d, Y') }}</span>
                </div>
                @if($order->status !== 'canceled')
                <button 
                    class="w-full px-4 py-2 mb-4 text-white bg-green-500 rounded-lg hover:bg-green-600" 
                    onclick="window.location.href='{{ route('my-orders.show', $order->id) }}'">
                    View Order
                </button>
                @endif
                <!-- Cancel Order Button -->
                <button 
                    class="w-full px-4 py-2 text-white transition rounded-lg 
                    @if($order->status === 'canceled') bg-gray-500 cursor-not-allowed @else bg-red-500 hover:bg-red-600 @endif"
                    onclick="cancelOrder({{ $order->id }})"
                    @if($order->status === 'canceled') disabled @endif>
                    Cancel Order
                </button>
                
                <!-- Additional Button that appears if order is active -->
                
            </div>
        @empty
            <p class="text-center text-gray-600">No orders found.</p>
        @endforelse
    </div>

    <!-- My Subscriptions Section -->
    <h2 class="mb-4 text-2xl font-bold text-gray-800">My Subscriptions</h2>
    
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($boxes as $box)
            <div class="p-4 bg-white border border-gray-300 rounded-lg shadow-md">
                <div class="mb-4">
                    <span class="block text-lg font-semibold text-gray-800">Subscription: {{ ucfirst($box->subscription_type) }}</span>
                    <span class="block text-gray-600">Status: 
                        @if ($box->status == '1') Active @else Canceled @endif
                    </span>
                    <span class="block text-gray-600">Next Billing: 
                        @if($box->type == 'monthly')
                            {{ $box->updated_at->copy()->addDays(28)->format('M d, Y') }}
                        @elseif($box->type == 'weekly')
                            {{ $box->updated_at->copy()->addDays(7)->format('M d, Y') }}
                        @else
                            {{ $box->updated_at->format('M d, Y') }}
                        @endif
                    </span>
                    <span class="block text-gray-600">Price: ${{ number_format($box->price, 2) }}</span>
                </div>
                    @if($box->status !== '1')
                    <button 
                    class="w-full px-4 py-2 mb-4 text-white bg-green-500 rounded-lg hover:bg-green-600" 
                    onclick="window.location.href='{{ route('my-box.show', $box->id) }}'">
                    View Box
                    </button>
                    @endif
                <button 
                    class="w-full px-4 py-2 text-white transition rounded-lg 
                    @if($box->status == '0') bg-gray-500 cursor-not-allowed @else bg-red-500 hover:bg-red-600 @endif"
                    onclick="cancelBox({{ $box->id }})"
                    @if($box->status == '0') disabled @endif>
                    Cancel Subscription
                </button>
            </div>
        @empty
            <p class="text-center text-gray-600">No subscriptions found.</p>
        @endforelse
    </div>
</div>
<script>

    let url = "http://127.0.0.1:8000/api/orders";
    let url2 = "http://127.0.0.1:8000/api/boxes";
    const token = localStorage.getItem('authToken');

    function cancelOrder(orderId) {

        const newStatus = 'canceled'; 
        
        if (token) {

            axios.patch(`${url}/${orderId}`, {
                status: newStatus
            }, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            })
            .then(response => {
                console.log('Order status updated to canceled');
                location.reload();
                
            })
            .catch(error => {
                
                console.error('Error updating order status:', error);
            });
        } else {
            console.error('Authentication required. Please log in to cancel the order.');
        }
    }

    // Add event listener to all cancel order buttons
    document.querySelectorAll('.cancel-order-btn').forEach(button => {
        button.addEventListener('click', function(event) {
            const orderId = event.target.getAttribute('data-order-id');
            cancelOrder(orderId);
        });
    });

    // Cancel Box function using Axios
    function cancelBox(boxId) {
        const newStatus = '0'; 
        
        if (token) {

            axios.patch(`${url2}/${boxId}`, {
                status: newStatus
            }, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            })
            .then(response => {
                console.log('Box status updated to canceled');
                location.reload();
                
            })
            .catch(error => {
                
                console.error('Error updating order status:', error);
            });
        } else {
            console.error('Authentication required. Please log in to cancel the order.');
        }
    }
    
    document.querySelectorAll('.cancel-box-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                const boxId = event.target.getAttribute('data-box-id');
                cancelBox(boxId);
            });
        });


        
</script>
