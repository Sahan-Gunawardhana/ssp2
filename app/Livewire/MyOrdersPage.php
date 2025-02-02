<?php

namespace App\Livewire;

use App\Models\Box;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class MyOrdersPage extends Component
{
    

    use WithPagination;

    #[Title('PawSome|Orders')]
    public function render()
    {
        return view('livewire.my-orders-page', [
            'orders' => Order::where('customer_id', Auth::id())->latest()->paginate(10),
            'boxes' => Box::where('customer_id', Auth::id())->latest()->paginate(10)
        ]);
    }

}
