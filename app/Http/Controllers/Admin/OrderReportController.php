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

        $pdf = PDF::loadView('admin.pdf.all-orders-day', ['products' => $products, 'date' => $date])->setPaper('a4', 'landscape');
 
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

        $pdf = PDF::loadView('admin.pdf.all-orders-month', ['products' => $products, 'date' => $date])->setPaper('a4', 'landscape');
 
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

        $pdf = PDF::loadView('admin.pdf.all-orders-range', ['products' => $products, 'date' => $date])->setPaper('a4', 'landscape');

        return $pdf->download('Todos-los-Pedidos-desde-'.$request->start1.'-hasta-'.$request->end1.'.pdf');
    }

    public function allOrdersAprovedDay(Request $request)
    {
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        
        $products = DB::table('orders')
                        ->select('id',
                                'firstname',   
                                'lastname',   
                                 'cedula',   
                                 'total',   
                                 'total_bs')
                        ->where('status', '=', 'aproved')
                        ->whereDate('created_at', $request->day2)->get();

        $pdf = PDF::loadView('admin.pdf.all-orders-aproved-day', ['products' => $products, 'date' => $date])->setPaper('a4', 'landscape');

        return $pdf->download('Todos-los-Pedidos-Entregados-Dia-'.$date->format('d-m-Y h:m:s').'.pdf');
    }

    public function allOrdersAprovedMonth(Request $request)
    {
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();

        $products = DB::table('orders')
                        ->select('id',
                                 'firstname',   
                                 'lastname',   
                                 'cedula',   
                                 'total',   
                                 'total_bs')
                        ->where('status', '=', 'aproved')         
                        ->whereMonth('created_at', '=', $request->mes2)
                        ->whereYear('created_at', '=', $request->years2)->get();
                                 
        $pdf = PDF::loadView('admin.pdf.all-orders-aproved-month', ['products' => $products, 'date' => $date])->setPaper('a4', 'landscape');
         
        return $pdf->download('Todos-los-Pedidos-Entregados-Mes-'.$date->format('m-Y h:m:s').'.pdf');
    }

    public function allOrdersAprovedRange(Request $request)
    {
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
    
        $products = DB::table('orders')
                        ->select('id',
                                 'firstname',   
                                 'lastname',   
                                 'cedula',   
                                 'total',   
                                 'total_bs')
                        ->where('status', '=', 'aproved')
                        ->whereBetween('created_at', [$request->start2, $request->end3])->get();
    
        $pdf = PDF::loadView('admin.pdf.all-orders-aproved-range', ['products' => $products, 'date' => $date])->setPaper('a4', 'landscape');
    
        return $pdf->download('Todos-los-Pedidos-Entregados-desde-'.$request->start2->date_format('d-m-Y').'-hasta-'.$request->end2->date_format('d-m-Y').'.pdf');
    }

    public function allOrdersCanceledDay(Request $request)
    {
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        
        $products = DB::table('orders')
                        ->select('id',
                                'firstname',   
                                'lastname',   
                                 'cedula',   
                                 'total',   
                                 'total_bs')
                        ->where('status', '=', 'canceled')
                        ->whereDate('created_at', $request->day3)->get();

        $pdf = PDF::loadView('admin.pdf.all-orders-canceled-day', ['products' => $products, 'date' => $date])->setPaper('a4', 'landscape');

        return $pdf->download('Todos-los-Pedidos-Cancelados-Dia-'.$date->format('d-m-Y h:m:s').'.pdf');
    }

    public function allOrdersCanceledMonth(Request $request)
    {
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();

        $products = DB::table('orders')
                        ->select('id',
                                 'firstname',   
                                 'lastname',   
                                 'cedula',   
                                 'total',   
                                 'total_bs')
                        ->where('status', '=', 'canceled')         
                        ->whereMonth('created_at', '=', $request->mes3)
                        ->whereYear('created_at', '=', $request->years3)->get();
                                 
        $pdf = PDF::loadView('admin.pdf.all-orders-canceled-month', ['products' => $products, 'date' => $date])->setPaper('a4', 'landscape');
         
        return $pdf->download('Todos-los-Pedidos-Cancelados-Mes-'.$date->format('m-Y h:m:s').'.pdf');
    }

    public function allOrdersCanceledRange(Request $request)
    {
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
    
        $products = DB::table('orders')
                        ->select('id',
                                 'firstname',   
                                 'lastname',   
                                 'cedula',   
                                 'total',   
                                 'total_bs')
                        ->where('status', '=', 'canceled')
                        ->whereBetween('created_at', [$request->start3, $request->end3])->get();
    
        $pdf = PDF::loadView('admin.pdf.all-orders-canceled-range', ['products' => $products, 'date' => $date])->setPaper('a4', 'landscape');
    
        return $pdf->download('Todos-los-Pedidos-Cancelados-desde-'.$request->start3->date_format('d-m-Y').'-hasta-'.$request->end3->date_format('d-m-Y').'.pdf');
    }
}
                            