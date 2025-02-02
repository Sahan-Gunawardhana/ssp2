<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

class ProductDetailPage extends Component
{
    use LivewireAlert;
    
    #[Title('PawSome|Product')]

    
    public $productId;
    public $product;
    public $quantity = 1;
        

    public function mount($productId)
    {
        // Retrieve the product based on the productId passed in the URL
        $this->productId = $productId;
        $this->product = Product::findOrFail($productId); // Fetch product details
    }

    public function addToCart($product_id){
        $total_count = CartManagement::addItemToCartWithQty($product_id, $this->quantity);

    // Dispatch the updated cart count to the Navbar (this line remains unchanged)
        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        // Show success alert
        $this->alert('success', 'Item added successfully!', [
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' => true
        ]);

    }

    public function increaseQ(){
        $this->quantity++;
    }
    public function decreaseQ(){
        if($this->quantity > 1){
            $this->quantity--;
        }
    }
    public function render()
    {
        return view('livewire.product-detail-page', [
            'product' => $this->product // Make sure the product is passed to the view
        ]);
    }
}
