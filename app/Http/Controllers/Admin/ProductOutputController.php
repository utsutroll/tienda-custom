<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Output;
use App\Models\ProductOutput;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        $products = Product::all();

        if($products->count() > 0)
        {
            foreach($products as $p){
                $product[$p->id] = $p->id = $p->name .' '. $p->presentation->name .' '. $p->presentation->medida;
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
            $stock_product = Product::find($product_id[$i]);
            if ($stock_product->stock < $quantity) {
                
                return redirect()->route('admin.product-output.create')->with('info', 'La cantidad de '.$stock_product->name.' que desa sacar es mayor al stock disponible.');
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
            $products = new ProductOutput();
            $products->product_id=$product_id[$cont];
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
        $product = ProductOutput::find($id);

        return view('admin.product-output.show',["product" => $product]);
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
}
