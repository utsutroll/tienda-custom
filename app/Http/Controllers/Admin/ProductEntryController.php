<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entry;
use App\Models\CharacteristicProduct;
use App\Models\CharacteristicProductEntry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;

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

                $products = new CharacteristicProductEntry();
                $products->characteristic_product_id=$product_id[$cont];
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
        $product = CharacteristicProductEntry::find($id);

        return view('admin.product-entry.show', compact("product"));
    }

    public function edit(CharacteristicProductEntry $product)
    {
        //
    }

    public function update(Request $request, CharacteristicProductEntry $product)
    {
        //
    }

    public function destroy(CharacteristicProductEntry $product)
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

        $products = DB::table('characteristic_product')
                        ->join('products', 'products.id', '=', 'characteristic_product.product_id')
                        ->join('brands', 'brands.id', '=', 'products.brand_id')
                        ->join('characteristics', 'characteristics.id', '=', 'characteristic_product.characteristic_id')
                        ->select('characteristic_product.id as id', 'products.name as name', 'brands.name as brand', 'characteristics.name as char', 'characteristic_product.stock as stock',)
                        ->get();

        $pdf = PDF::loadview('admin.pdf.stock-product', compact('products', 'date'));

        return $pdf->download('Stock-de-Productos-'.$date->format('d-m-Y h:m:s').'.pdf');
    }
}
