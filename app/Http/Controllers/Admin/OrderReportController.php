<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CharacteristicProductOrder;
use App\Models\Order;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderReportController extends Controller
{
    public function allOrdersDay(Request $request)
    {
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();

        $products = CharacteristicProductOrder::all();

        $pdf = PDF::loadview('admin.pdf.all-orders-day', compact('products', 'date'));
 
        return $pdf->download('Todos-los-Pedidos-Dia-'.$date->format('d-m-Y h:m:s').'.pdf');
    }
}
