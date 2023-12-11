<?php

namespace App\Livewire;

use App\Models\Attribute;
use App\Models\Product;
use App\Services\CartService;
use Livewire\Component;

class ShopList extends Component
{
    public $products;
    public $productAttributes = [];

    public function mount()
    {
        $this->products = Product::all();
    }

    public function addToCart($productId)
    {
        $this->dispatch('cart-updated');
        CartService::addToCart($this->productAttributes);

    }

    public function render()
    {
        return view('livewire.shop-list');
    }
}
