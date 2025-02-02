<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class MyOrderDetailPage extends Component
{
    #[Title('PawSome|Orders')]

    
    public $order;

    public function mount($orderId)
    {
        $this->order = Order::with('orderItems.product')->findOrFail($orderId);
    }

    public function render()
    {
        return view('livewire.my-order-detail-page', [
            'order' => $this->order,
        ]);
    }
}