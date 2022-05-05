<?php

namespace App\Http\Livewire\Admin;

use App\Models\DollarRate;
use Livewire\Component;
use DB;

class AdminUpdateDollarComponent extends Component
{
    public $priced;

    public function render()
    {
        $dolar = DollarRate::find(1);

        if($dolar != null) 
        {
            $this->priced = $dolar->price;
        }
        
        return view('livewire.admin.admin-update-dollar-component');
    }

    public function update()
    {
        $dollar = DollarRate::find(1);

        if($dollar == null)
        {
            DollarRate::create([
                'price' => $this->priced,
            ]);
        }else 
        {
            $dollar->update([
                'price' => $this->priced,
            ]);
        }
        
        $this->emit('dollarEdited');
    }
}
