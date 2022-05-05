<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdminDashboardComponent extends Component
{
    public $pending;
    public $delivered;
    public $canceled;
    public $users;


    public function render()
    {
        $ordered = DB::table('orders')
                        ->where('status', 'ordered')->get();
        $dilivere = DB::table('orders')
                        ->where('status', 'delivered')->get();
        $cancel = DB::table('orders')
                        ->where('status', 'canceled')->get();

        $this->pending = count($ordered);                
        $this->delivered = count($dilivere);                
        $this->canceled = count($cancel);       
        
        $user = DB::table('users')
                    ->where('utype', 'USR')->get();

        $this->users = count($user);

        return view('livewire.admin.admin-dashboard-component')->layout('layouts.base-a');
    }
}
