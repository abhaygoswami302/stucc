<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class FrontSearch extends Component
{
    public $searchTerm;
    public $products = [];
    public function render()
    {
        if($this->searchTerm <> ""){
            $searchTerm = '%' . $this->searchTerm . '%';
          /*  $this->products = Product::where('name', 'like', $searchTerm)
                                    ->orWhere('category_name', 'like', $searchTerm)
                                    ->orWhere('collection_name', 'like', $searchTerm)
                                    ->get();*/
        }else{
            $this->products = [];
        }
        return view('livewire.front-search');
    }
}
