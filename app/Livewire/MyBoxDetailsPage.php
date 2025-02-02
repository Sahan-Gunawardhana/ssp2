<?php

namespace App\Livewire;

use App\Models\Box;
use Livewire\Attributes\Title;
use Livewire\Component;

class MyBoxDetailsPage extends Component
{
    #[Title('PawSome|Subscriptions')]

    public $box;

    public function mount($boxId)
    {
        // Fetch the order with its items
        $this->box = Box::with('boxItems.product')->findOrFail($boxId);
    }

    public function render()
    {
        return view('livewire.my-box-details-page');
    }
}
