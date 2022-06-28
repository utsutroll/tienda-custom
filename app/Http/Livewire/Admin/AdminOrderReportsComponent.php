<?php

namespace App\Http\Livewire\Admin;

use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdminOrderReportsComponent extends Component
{
    public $panel = 'dia';
    public $panel1 = 'dia1';
    public $panel2 = 'dia2';
    public $tab = 'all';

    public function render()
    {
        return view('livewire.admin.admin-order-reports-component')->layout('layouts.base-a');
    }

}
