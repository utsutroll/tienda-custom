<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use App\Imports\ProductsImportOffer;
use App\Models\Category;
use App\Models\Presentation;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

class ProductController extends Controller
{

    public function index()
    {

        return view('admin.products.index');
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id');
        $tags = Tag::pluck('name', 'id');
        $presentations = Presentation::all();

        $presents = [];

        foreach($presentations as $p){
                $presents[$p->id] = $p->name .' '. $p->medida;
            }

        return view('admin.products.create', compact('categories', 'tags', 'presents'));
    }

    

    public function store(Request $request)
    {
        /* dd($request); */

        $request->validate([
            'id' => 'required|numeric|min:1|unique:products,id',   
            'name' => 'required',   
            'category_id' => 'required',  
            'presentation_id' => 'required',    
            'tags' => 'required',    
            'details' => 'required',
            'file' => 'required|image'

        ]);
            
        $continuar = $request->continue;

        $present=Presentation::find($request->presentation_id);

        
        $slug = Str::slug($request->name.'-'.$present->name.'-'.$present->medida);
        $product_slug = Product::where('slug', $slug)->get();

        if ($product_slug->count() > 0 ) 
        {
            return redirect()->route('admin.products.create')->with('slug', 'El nombre del producto con esa presentación ya existe.');
            die();
        }

        $product = Product::create([
            'id' => $request->id,   
            'name' => $request->name,   
            'category_id' => $request->category_id,  
            'presentation_id' => $request->presentation_id,               
            'slug' => $slug,        
            'details' => $request->details,

        ]);

        if($request->file('file')){
            $url = Storage::put('products', $request->file('file'));     
            
            $product->image()->create([
                'url' => $url
            ]);
        }

        if($request->tags){
            $product->tags()->attach($request->tags);
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
        $tags = Tag::pluck('name', 'id');
        $presentations = Presentation::all();

        foreach($presentations as $p){
            $presents[$p->id] = $p->id = $p->name .' '. $p->medida;
        }

        return view('admin.products.edit', compact('product', 'categories', 'tags', 'presents'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'id' => "unique:products,id,$product->id",   
            'name' => "required",   
            'category_id' => 'required',  
            'presentation_id' => 'required',    
            'tags' => 'required',    
            'details' => 'required',
            'slug' => "unique:products,slug,$product->slug"

        ]);

         

        $present=Presentation::find($request->presentation_id);

        /* $slug = Str::slug($request->name.'-'.$present->name.'-'.$present->medida);
        $product_slug = Product::where('slug', $slug)->get();

        if ($product_slug->count() > 0 ) 
        {
            return redirect()->route('admin.products.edit')->with('slug', 'El nombre del producto con esa presentación ya existe.');
            die();
        } */
        
        $product->update([
            'name' => $request->name,   
            'category_id' => $request->category_id,  
            'presentation_id' => $request->presentation_id,       
            'slug' => Str::slug($request->name.'-'.$present->name.'-'.$present->medida),        
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

        if($request->tags){
            $product->tags()->sync($request->tags);
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

        $products = Product::where('sale_price', '>', 0);
        $sale = Sale::find(1);

        $pdf = PDF::loadview('admin.pdf.offer-product', compact('products', 'date', 'sale'));

        return $pdf->download('Productos-en-Oferta-'.$date->format('d-m-Y h:m:s').'.pdf');
    }
}
