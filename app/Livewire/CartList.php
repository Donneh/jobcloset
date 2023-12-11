<?php

namespace App\Livewire;

use Livewire\Component;

class CartList extends Component
{

    public $items;

    public function render()
    {
        return view('livewire.cart-list');
    }
}
