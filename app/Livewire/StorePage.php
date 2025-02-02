<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class StorePage extends Component
{

    use LivewireAlert;
    public $minPrice = 5;
    public $maxPrice = 100;
    
    use WithPagination;

    #[Title('PawSome|Store')]

    public $perPage = 8; 
    public $cart = [];
    public $quantities = [];
    public $selectedCategories = [];
    public $sortBy = 'latest'; 

    public function getCartCountProperty()
    {
        return array_sum($this->cart);
    }

    public function mount()
    {
        // Initialize cart from session
        $this->cart = Session::get('cart', []);
    }

    public function updatedMaxPrice()
    {
        $this->resetPage(); // Reset pagination when price filter changes
    }
    // Toggle the category filter
    public function toggleCategory($category)
    {
        // Add or remove category from selectedCategories array
        if (in_array($category, $this->selectedCategories)) {
            $this->selectedCategories = array_filter($this->selectedCategories, fn($c) => $c !== $category);
        } else {
            $this->selectedCategories[] = $category;
        }
    }

    public function addToCart($product_id){
        $total_count = CartManagement::addItemToCart($product_id);

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        $this->alert('success', 'Item added successfully!', [
            'position' => 'bottom-end',
            'timer'=> 3000,
            'toast'=> true
        ]);
    }

    // Render the store page with products, filtered by selected categories
    public function render()
    {
        $products = Product::when($this->selectedCategories, function($query) {
            return $query->whereIn('category', $this->selectedCategories);
        })->when($this->maxPrice, function($query) {
            return $query->whereBetween('pro_price', [$this->minPrice, $this->maxPrice]);
        });

        // Sorting logic
        if ($this->sortBy === 'latest') {
            $products = $products->orderBy('created_at', 'desc');
        } elseif ($this->sortBy === 'price_high_to_low') {
            $products = $products->orderBy('pro_price', 'desc');
        }

        // Paginate the products
        $products = $products->paginate($this->perPage);
        

        return view('livewire.store-page', compact('products'));
        
    }   
}

