<?php

namespace App\Http\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum;

class UserDashboardComponent extends Component
{
    public $pending;
    public $delivered;
    public $canceled;
    public $users;

    public function render()
    {

        $ordered = DB::table('orders')
                        ->where('user_id', Auth::user()->id)
                        ->where('status', 'ordered')->get();
        $dilivere = DB::table('orders')
                        ->where('user_id', Auth::user()->id)
                        ->where('status', 'delivered')->get();
        $cancel = DB::table('orders')
                        ->where('user_id', Auth::user()->id)
                        ->where('status', 'canceled')->get();
             
        $this->pending = count($ordered);                
        $this->delivered = count($dilivere);                
        $this->canceled = count($cancel);       
        
        $user = DB::table('orders')
                    ->select(DB::raw('SUM(total) as totals'))    
                    ->where('user_id', Auth::user()->id)
                    ->where('status', 'delivered')->get();

        $this->users = $user[0]->totals;

        return view('livewire.user.user-dashboard-component')->layout('layouts.base');
    }
}
