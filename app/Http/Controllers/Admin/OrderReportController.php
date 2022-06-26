<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderReportController extends Controller
{
    public function allOrdersDay(Request $request)
    {
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();

        $products = DB::table('orders')
                        ->select('id',
                                 'firstname',   
                                 'lastname',   
                                 'cedula',   
                                 'total',   
                                 'total_bs',   
                                 'status')
                        ->whereDate('created_at', '=', $request->day1)->get();

        $pdf = PDF::loadView('admin.pdf.all-orders-day', ['products' => $products, 'date' => $date]);
 
        return $pdf->download('Todos-los-Pedidos-del-Dia-'.$date->format('d-m-Y h:m:s').'.pdf');
    }

    public function allOrdersMonth(Request $request)
    {
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();

        $products = DB::table('orders')
                        ->select('id',
                                 'firstname',   
                                 'lastname',   
                                 'cedula',   
                                 'total',   
                                 'total_bs',   
                                 'status')
                        ->whereMonth('created_at', '=', $request->mes1)
                        ->whereYear('created_at', '=', $request->years1)->get();

        $pdf = PDF::loadView('admin.pdf.all-orders-month', ['products' => $products, 'date' => $date]);
 
        return $pdf->download('Todos-los-Pedidos-del-Mes-'.$date->format('m-Y h:m:s').'.pdf');
    }

    public function allOrdersRange(Request $request)
    {
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();

        $products = DB::table('orders')
                        ->select('id',
                                 'firstname',   
                                 'lastname',   
                                 'cedula',   
                                 'total',   
                                 'total_bs',   
                                 'status')
                        ->whereBetween('created_at', [$request->start1, $request->end1])->get();

        $pdf = PDF::loadView('admin.pdf.all-orders-range', ['products' => $products, 'date' => $date]);
 
        return $pdf->download('Todos-los-Pedidos-desde-'.$request->start1.'-hasta-'.$request->end1.'.pdf');
    }
}
