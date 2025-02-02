<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Pawsome|Cart')]

class CartPage extends Component
{
    public $cart_items = [];
    public $ttl;

    public function mount(){
        $this->cart_items = CartManagement::getCartItemsFromCookie();
        $this->ttl = CartManagement::calculateTotal($this->cart_items);
    }


    public function removeItem($product_id){
        $this->cart_items = CartManagement::removeCartItem($product_id);
        $this->ttl = CartManagement::calculateTotal($this->cart_items);

        $this->dispatch('update-cart-count', total_count: count($this->cart_items))->to(Navbar::class);
    }

    public function increaseQty($product_id){
        $this->cart_items = CartManagement::incrementQuantity($product_id);
        $this->ttl = CartManagement::calculateTotal($this->cart_items);
    }

    public function decreaseQty($product_id){
        $this->cart_items = CartManagement::decrementQuantity($product_id);
        $this->ttl = CartManagement::calculateTotal($this->cart_items);
    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}
