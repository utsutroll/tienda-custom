<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entry;
use App\Models\Product;
use App\Models\ProductEntry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class ProductEntryController extends Controller
{
    
    public function index()
    {
        return view('admin.product-entry.index');
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

        return view('admin.product-entry.create', compact('product', 'date'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id'=>'required',
            'quantity'=>'required'
        ]);

        $continuar = $request->continue;


    		$entrada = new Entry();
            $mytime = Carbon::now();
	    	$entrada->date=$mytime->toDateTimeString();
	    	$entrada->time=$request->time;
	    	$entrada->save();

	    	$product_id=$request->product_id;
	    	$quantity=$request->quantity;

	    	$cont = 0;

	    	while($cont < count($product_id)){

                $products = new ProductEntry();
                $products->product_id=$product_id[$cont];
                $products->entry_id=$entrada->id;
                $products->quantity=$quantity[$cont];
                $products->save();
                $cont=$cont+1;
	    	}

        if($continuar == "on"){

            return redirect()->route('admin.product-entry.create');

        }else{
            return redirect()->route('admin.product-entry.index')->with('info', 'La Entrada se registró con éxito.');
        }
    }

    public function show($id)
    {
        $product = ProductEntry::find($id);

        return view('admin.product-entry.show',["product" => $product]);
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }

    public function stock()
    {
        return view('admin.product-entry.stock');
    }
    
    public function exportStockPDF()
    {
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();

        $products = Product::all();
        $pdf = PDF::loadview('admin.pdf.stock-product', compact('products', 'date'));

        return $pdf->download('Stock-de-Productos-'.$date->format('d-m-Y h:m:s').'.pdf');
    }
}
