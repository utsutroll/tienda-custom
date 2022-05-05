<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function index()
    {
        return view('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([   
            'title' => 'required|unique:sliders,title',   
            'subtitle' => 'required',  
            'detail' => 'required',    
            'status' => '1',
            'file'  => 'required|image'
        ]);
            
        $continuar = $request->continue;

        $slider = Slider::create([
            'title' => $request->title,   
            'subtitle' => $request->subtitle,  
            'detail' => $request->detail,        
            'slug' => Str::slug($request->title),
            'link' => $request->link,
        ]);

        if($request->file('file')){
            $url = Storage::put('sliders', $request->file('file'));     
            
            $slider->image()->create([
                'url' => $url
            ]);
        }

        if($continuar == "on"){

            return redirect()->route('admin.slider.create')->with('info', 'la Imagen Promocional se creó con éxito.');

        }else{
            return redirect()->route('admin.slider.index')->with('info', 'la Imagen Promocional se creó con éxito.');
        }
    }

    public function show(Slider $slider)
    {
        return view('admin.slider.show', compact('slider'));
    }

    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([   
            'title' => "required|unique:sliders,title,$slider->id",   
            'subtitle' => 'required',  
            'detail' => 'required',
        ]);
        
        $slider->update([
            'title' => $request->title,   
            'subtitle' => $request->subtitle,  
            'detail' => $request->detail,        
            'slug' => Str::slug($request->title),
            'link' => $request->link,

        ]);

        if($request->file('file')){
            $url = Storage::put('sliders', $request->file('file'));     
            
            if ($slider->image) {
                Storage::delete($slider->image->url);

                $slider->image->update([
                    'url' => $url
                ]);

            }else{

                $slider->image()->create([
                    'url' => $url
                ]);
            }
        }

        return redirect()->route('admin.slider.index')->with('info_e', 'la Imagen Promocional se actualizó con éxito.');
    }

    public function destroy(Slider $slider)
    {
        //
    }
}