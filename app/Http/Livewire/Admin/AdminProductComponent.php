<?php

namespace App\Http\Livewire\Admin;

use App\Models\Image;
use App\Models\Product;
use Livewire\Component;


class AdminProductComponent extends Component
{

    protected $listeners = ['render', 'render'];

    public function render()
    {

        $products = Product::all();

        return view('livewire.admin.admin-product-component', compact('products'));
    }

    /* Destroy */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $images = Image::where('imageable_id', $id);

        try {
            $product->delete();
            $images->delete(); 
            
            $this->emit('productDeleted');
            
        } catch (\Exception $e) {

            $this->emit('ProductDeleted_e');
        }

    }
    /*End Destroy*/
}
