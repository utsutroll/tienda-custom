<?php

namespace App\Http\Livewire\Admin;

use App\Models\Characteristic;
use App\Models\CharacteristicProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DeleteCharacteristic extends Component
{
    public $product;
    public $characteristics;
     
    protected $listeners = ['render', 'render'];
    
    public function render()
    {
        
        return view('livewire.admin.delete-characteristic');
    }

    public function delete($id)
    {
        $characteristic = DB::table('characteristic_product')->select('id', 'image', 'product_id')->where('id', '=', $id)->get();
        

        $entry = DB::table('characteristic_product_entry')->where('characteristic_product_id', $characteristic[0]->id)->get();
        $output = DB::table('characteristic_product_output')->where('characteristic_product_id', $characteristic[0]->id)->get();
        $order = DB::table('characteristic_product_order')->where('characteristic_product_id', $characteristic[0]->id)->get();

        if(count($entry) == null & count($output) == null & count($order) == null) {
            
            foreach ($characteristic as  $c) {
                if ($c->image != '') {
                    Storage::delete($c->image);
                }

            }
            DB::table('characteristic_product')->where('id', '=', $id)->delete();
            
            $this->emit('render');

            $this->emit('CharDeleted');

        }else {
            try {
                Storage::delete($characteristic->image);
                $characteristic->delete();
                
                $this->emit('CharDeleted');
                $this->emit('render');
                
            } catch (\Exception $e) {
    
                $this->emit('CharDeleted_e');
            }
        }
    }
}
