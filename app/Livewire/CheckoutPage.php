<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use Livewire\Attributes\Title;
use Livewire\Component;

class CheckoutPage extends Component
{
    #[Title('PawSome|Checkout')]

    public function clearCart(){
        CartManagement::clearCartItems();
    }

    public function render()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        $ttl = CartManagement::calculateTotal($cart_items);
        return view('livewire.checkout-page', [
            'cart_items' => $cart_items,
            'ttl' => $ttl,
            'taxes' => 0
        ]);
    }
}
