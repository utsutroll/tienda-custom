<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use App\Imports\ProductsImportOffer;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Characteristic;
use App\Models\CharacteristicProduct;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index()
    {

        return view('admin.products.index');
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id');
        $brands = Brand::pluck('name', 'id');
        $characteristics = Characteristic::pluck('name', 'id');
        $product_characteristic = CharacteristicProduct::all();


        return view('admin.products.create', compact('categories', 'brands', 'characteristics', 'product_characteristic'));
    }

    

    public function store(Request $request)
    {
        /*dd($request);*/

        $request->validate([
            'id' => 'required|numeric|unique:products,id',   
            'name' => 'required',   
            'category_id' => 'required',
            'subcategory_id' => 'required',  
            'brand_id' => 'required',  
            'details' => 'required',
            'file' => 'required|image'

        ]);
            
        $continuar = $request->continue;

        $brandss=Brand::find($request->brand_id);
        
        $slug = Str::slug($request->name.'-'.$brandss->name);
        $product_slug = Product::where('slug', $slug)->get();

        if ($product_slug->count() > 0 ) 
        {
            return redirect()->route('admin.products.create')->with('slug', 'El nombre del producto con esa presentación ya existe.');
            die();
        }

        $product = Product::create([
            'id' => $request->id,   
            'name' => $request->name,   
            'subcategory_id' => $request->subcategory_id,              
            'brand_id' => $request->brand_id,               
            'slug' => $slug,        
            'details' => $request->details,

        ]);

        if($request->file('file')){
            $url = Storage::put('products', $request->file('file'));     
            
            $product->image()->create([
                'url' => $url
            ]);
        }

        $product_id=$request->id;
        $characteristic_id=$request->characteristic;
        $files = $request->file('image');

        if($request->characteristic & $request->file('image')){
            $cont = 0;
	    	while($cont < count($files)){
                
                $imagen = Storage::put('/products/images', $files[$cont]);

                CharacteristicProduct::create([
                    'characteristic_id' => $characteristic_id[$cont],
                    'product_id' => $product_id,
                    'image' => $imagen,
                ]);
                $cont=$cont+1;
	    	}
            
        }
        
        if($continuar == "on"){
            
            return redirect()->route('admin.products.create')->with('info', 'El Producto se creó con éxito.');

        }else{
            return redirect()->route('admin.products.index')->with('info', 'El Producto se creó con éxito.');
        }
        

    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::pluck('name', 'id');
        $subcategories = Subcategory::all();
        $brands = Brand::pluck('name', 'id');
        $characteristics = Characteristic::pluck('name', 'id');

        return view('admin.products.edit', compact('product', 'categories', 'subcategories', 'brands', 'characteristics'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'id' => "unique:products,id,$product->id",   
            'name' => "required",   
            'category_id' => 'required', 
            'subcategory_id' => 'required',  
            'brand_id' => 'required',   
            'details' => 'required',
            'slug' => "unique:products,slug,$product->slug"

        ]);
         
        $brandss=Brand::find($request->brand_id);
        
        $product->update([
            'name' => $request->name,   
            'subcategory_id' => $request->subcategory_id,                
            'brand_id' => $request->brand_id,      
            'slug' => Str::slug($request->name.'-'.$brandss->name),        
            'details' => $request->details,
        ]);

        if($request->file('file')){
            $url = Storage::put('products', $request->file('file'));     
            
            if ($product->image) {
                Storage::delete($product->image->url);

                $product->image->update([
                    'url' => $url
                ]);

            }else{

                $product->image()->create([
                    'url' => $url
                ]);
            }
        }

        $files = $request->file('image');

        if($request->characteristic & $request->file('image')){

            foreach($product->characteristics as $c){
                if ($request->characteristic != $c->characteristic_id | $request->file('image') != $c->image) {

                    Storage::delete($c->image);
                    
                    $imagen = Storage::put('/products/images', $files);

                    $product->characteristics->update([
                        'characteristic_id' => $request->characteristic_id,
                        'image' => $imagen,
                    ]);
                }
                
	    	}
            
        }

        if($request->charact & $request->file('imge') & $request->activar == 'on'){
            
            $charact_id=$request->charact;
            $file = $request->file('imge');

            $cont = 0;
            while($cont < count($file)){
                    
                $imgen = Storage::put('/products/images', $file[$cont]);

                CharacteristicProduct::create([
                    'characteristic_id' => $charact_id[$cont],
                    'product_id' => $product->id,
                    'image' => $imgen,
                ]);
                $cont=$cont+1;
            }
            
        }

        return redirect()->route('admin.products.index')->with('info_e', 'El Producto se actualizó con éxito.');
    }


    public function destroy(Product $product)
    {
        //
    }

    public function import(Request $request)
    {
        $products = Excel::toCollection(new ProductsImport(), $request->file);

        foreach($products[0] as $p)
        {
            Product::where('id', $p[0])->update([
                'price' => $p[1],
            ]);
        }

        return redirect()->back()->with('info_p', 'Los precios se actualizaron con éxito.');
    }

    public function importOffer(Request $request)
    {
        $products = Excel::toCollection(new ProductsImportOffer(), $request->file_import);

        foreach($products[0] as $p)
        {
            Product::where('id', $p[0])->update([
                'sale_price' => $p[1],
            ]);
        }

        return redirect()->back()->with('info_p', 'Los precios se actualizaron con éxito.');
    }

    public function exportOfferPDF()
    {
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();

        $products = DB::table('characteristic_product')
                        ->join('products', 'products.id', '=', 'characteristic_product.product_id')
                        ->join('brands', 'brands.id', '=', 'products.brand_id')
                        ->join('characteristics', 'characteristics.id', '=', 'characteristic_product.characteristic_id')
                        ->select('characteristic_product.id as id', 'products.name as name', 'brands.name as brand', 'characteristics.name as char', 'characteristic_product.price as price', 'characteristic_product.sale_price as sale_price')
                        ->where('characteristic_product.sale_price', '>', 0)->get();
               
        $sale = Sale::find(1);

        $pdf = PDF::loadview('admin.pdf.offer-product', compact('products', 'date', 'sale'));

        return $pdf->download('Productos-en-Oferta-'.$date->format('d-m-Y h:m:s').'.pdf');
    }

}
