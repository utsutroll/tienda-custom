<?php

namespace App\Http\Livewire\Admin;

use App\Models\BusinessPartner;
use Livewire\Component;

class AdminBusinessPartnerComponent extends Component
{

    protected $listeners = ['render', 'render'];

    public function render()
    {
        $partners = BusinessPartner::all();

        return view('livewire.admin.admin-business-partner-component', compact('partners'));
    }

    /* Destroy */

    public function destroy($id)
    {
        $slider = BusinessPartner::findOrFail($id);

        try {
            $slider->delete();
            $this->emit('partnerDeleted');
            
        } catch (\Exception $e) {

            $this->emit('partnerDeleted_e');
        }
        
        $this->emit('render');

    }
    /* End Destroy */
}
