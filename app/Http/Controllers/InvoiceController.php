<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function userInvoiceReport(Request $request){

        $dollar = DB::table('dollar_rates')->select('price')->get();

        $order = Order::where('user_id',Auth::user()->id)
                        ->where('id', $request->order_id)->first();

        $pdf = PDF::loadview('admin.pdf.user-invoices', compact('order', 'dollar'))->setPaper('a4');

        return $pdf->download('Factura-'.$order->created_at->format('d-m-Y h:m:s').'.pdf');
    }
}
