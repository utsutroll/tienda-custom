<?php

namespace App\Http\Livewire;

use App\Mail\SendContactForm;
use App\Models\Slider;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class AboutComponent extends Component
{
    public $name;
    public $email;
    public $subject;
    public $mensaje;

    public function render()
    { 
        $sliders = Slider::all(); 

        return view('livewire.about-component', compact('sliders'))->layout('layouts.base');
    }

    protected $rules = [
        'name' => 'required|string|min:5|max:100',   
        'email' => 'required|email|min:5|max:100',   
        'subject' => 'required|string|min:5|max:100',   
        'mensaje' => 'required|string|min:5|max:250',   
    ];

    protected $validationAttributes = [
        'name' => 'Nombre y Apellido',
        'email' => 'Correo',
        'subject' => 'Asunto',
        'mensaje' => 'Mensaje',
    ];

    public function ContactForm() {
        $this->validate();


        Mail::to('inversionesmekaturen@gmail.com')->send(
            new SendContactForm(
                $this->name,
                $this->email,
                $this->subject,
                $this->mensaje,
            )
        );

        $this->emit('sendMessaje');
        $this->reset(['name']);
        $this->reset(['email']);
        $this->reset(['subject']);
        $this->reset(['mensaje']);

    }
}
