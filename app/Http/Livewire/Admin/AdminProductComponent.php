<?php

namespace App\Http\Livewire\Admin;

use App\Models\CharacteristicProduct;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
        $characteristic = DB::table('characteristic_product')->select('id', 'image', 'product_id')->where('product_id', '=', $id)->get();

        $entry = DB::table('characteristic_product_entry')->where('characteristic_product_id', $characteristic[0]->id)->get();
        $output = DB::table('characteristic_product_output')->where('characteristic_product_id', $characteristic[0]->id)->get();
        $order = DB::table('characteristic_product_order')->where('characteristic_product_id', $characteristic[0]->id)->get();

        if(count($entry) == null & count($output) == null & count($order) == null) {
            
            foreach ($characteristic as  $c) {

                if ($c->image != '') {
                    Storage::delete($c->image);
                }

            }
            
            Storage::delete($product->image->url);
            $product->delete();
            $images->delete(); 

            $this->emit('productDeleted');
            $this->emit('render');
        }else {
            try {
                Storage::delete($characteristic->image);
                $characteristic->delete();
                Storage::delete($product->image->url);
                $product->delete();
                $images->delete(); 
                
                $this->emit('productDeleted');
                $this->emit('render');
                
            } catch (\Exception $e) {
    
                $this->emit('ProductDeleted_e');
                $this->emit('render');
            }
        }
        

    }
    /*End Destroy*/
}
