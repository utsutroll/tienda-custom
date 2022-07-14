<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Output;
use App\Models\CharacteristicProductOutput;
use App\Models\CharacteristicProduct;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductOutputController extends Controller
{
    
    public function index()
    {
        return view('admin.product-output.index');
    }

    public function create()
    {
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();

        $products = CharacteristicProduct::all();

        if($products->count() > 0)
        {
            foreach($products as $p){
                $product[$p->id] = $p->id = $p->product->name .' '. $p->product->brand->name .' '. $p->characteristic->name;
            }
        }
        else 
        {
            $product[1] = "Registros no encontrados";
        }

        return view('admin.product-output.create', compact('product', 'date'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id'=>'required',
            'quantity'=>'required'
        ]);

        $continuar = $request->continue;
        $product_id=$request->product_id;
		$quantity=$request->quantity;
        $observation=$request->observation;
        $i = 0;

        while($i < count($product_id))
        {
            $stock_product = CharacteristicProduct::find($product_id[$i]);

            if ($stock_product->stock < $quantity[$i]) {
                
                return redirect()->route('admin.product-output.create')->with('info', 'La cantidad de '.$stock_product->product->name.' que desa sacar es mayor al stock disponible.');
                die();
            }
            $i=$i+1;
        }

    	$output = new Output();
        $mytime = Carbon::now();
		$output->date=$mytime->toDateTimeString();
		$output->time=$request->time;
        $output->save();
        
		
        $cont = 0;
        
		while($cont < count($product_id)){
            $products = new CharacteristicProductOutput();
            $products->characteristic_product_id=$product_id[$cont];
            $products->output_id=$output->id;
            $products->quantity=$quantity[$cont];
            $products->observation=$observation[$cont];
            $products->save();
            $cont=$cont+1;
		}

        if($continuar == "on"){

            return redirect()->route('admin.product-output.create');

        }else{
            return redirect()->route('admin.product-output.index')->with('info', 'La Salida se registró con éxito.');
        }
    }

    public function show($id)
    {
        //$product = CharacteristicProductOutput::find($id);

        //return view('admin.product-output.show', compact("product"));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function exportOutputPDF()
    {
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();

        $products = DB::table('characteristic_product')
                        ->join('products', 'products.id', '=', 'characteristic_product.product_id')
                        ->join('brands', 'brands.id', '=', 'products.brand_id')
                        ->join('characteristics', 'characteristics.id', '=', 'characteristic_product.characteristic_id')
                        ->join('characteristic_product_output', 'characteristic_product_output.characteristic_product_id', '=', 'characteristic_product.id')
                        ->join('outputs', 'outputs.id', '=', 'characteristic_product_output.output_id')
                        ->select( 
                            'products.name as name', 
                            'brands.name as brand', 
                            'characteristics.name as char', 
                            'characteristic_product_output.quantity as quantity',
                            'characteristic_product_output.observation as observation',
                            'outputs.date as date',
                            'outputs.time as time'
                            )
                        ->get();

        $pdf = PDF::loadview('admin.pdf.output-product', compact('products', 'date'))->setPaper('a4', 'landscape');

        return $pdf->download('Listado-de-salidas-de-productos-'.$date->format('d-m-Y h:m:s').'.pdf');
    }
}
