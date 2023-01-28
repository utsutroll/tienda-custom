<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AdminUsersComponent extends Component
{
    /* Variables */
    public $name;
    public $lastname;
    public $email;
    public $password;
    public $document;
    public $document_number;
    public $sexo;
    public $user_id;
    public $view = 'addUser';
    /* End Variables */

    protected $listeners = ['render', 'render'];

    public function render()
    {
        $users = User::where('utype', 'ADM')
                    ->where('su', 0)->get();

        return view('livewire.admin.admin-users-component', compact('users'))->layout('layouts.base-a');
    }

    /* Create */
    public function create()
    {
        $this->reset(['name']);
        $this->reset(['lastname']);
        $this->reset(['email']);
        $this->reset(['password']);
        $this->reset(['document']);
        $this->reset(['document_number']);
        $this->reset(['sexo']);
    }

    protected $rules = [
        'name' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',  
        'password' => 'required',  
        'document' => 'required',  
        'document_number' => 'required',  
        'sexo' => 'required',  
    ];

    protected $validationAttributes = [
        'name' => 'Nombre',
        'lastname' => 'Apellido',
        'email' => 'Correo',
        'password' => 'Contraseña',
        'document' => 'Documento',
        'document_number' => 'Número de Documento',
        'sexo' => 'Sexo',
    ];

    public function save(){ 
        
        $this->validate();
        $this->emit('render');

        $user = new User();
        $user->name = $this->name;
        $user->lastname = $this->lastname;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->document = $this->document;
        $user->document_number = $this->document_number;
        $user->sexo = $this->sexo;
        $user->save();    

        User::where('id', $user->id)->update([
            'utype' => "ADM",
        ]);

        $this->reset(['name']);
        $this->reset(['lastname']);
        $this->reset(['email']);
        $this->reset(['password']);
        $this->reset(['document']);
        $this->reset(['document_number']);
        $this->reset(['sexo']);

        $this->emit('render');

        $this->emit('userAdded');
    }
    /* End Create  */

    /* Edit/Update */

    public function edit($id)
    {
        $user = User::find($id);

        $this->user_id = $id;
        $this->name = $user->name;
        $this->lastname = $user->lastname;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->document = $user->document;
        $this->document_number = $user->document_number;
        $this->sexo = $user->sexo;
  
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',   
            'lastname' => 'required|string|max:255',   
            'email' => "required|string|email|max:255|unique:users,email,$this->user_id",  
            'password' => 'required',   
            'document' => 'required',  
            'document_number' => 'required',  
            'sexo' => 'required',
        ]);

        $user = User::find($this->user_id);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            
        ]);

        $this->reset(['name']);
        $this->reset(['name']);
        $this->reset(['email']);
        $this->reset(['password']);
        $this->reset(['document']);
        $this->reset(['document_number']);
        $this->reset(['sexo']);

        $this->emit('userEdited');
        
    }
    /* End Edit/Update */

    /* Destroy */

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        try {
            $user->update([
                'status' => '1'
            ]);
            $this->emit('userDeleted');
            
        } catch (\Exception $e) {

            $this->emit('userDeleted_e');
        }

    }
    /* End Destroy */
}
