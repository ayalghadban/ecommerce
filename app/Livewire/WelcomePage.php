<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class WelcomePage extends Component
{
    public $products;
    public function render()
    {
        $this->products = Product::all();
        return view('livewire.welcome-page');
    }
}
