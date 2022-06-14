<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AdminUsersComponent extends Component
{
    /* Variables */
    public $name;
    public $email;
    public $password;
    public $user_id;
    public $view = 'addUser';
    /* End Variables */

    protected $listeners = ['render', 'render'];

    public function render()
    {
        $users = User::where('utype', 'ADM')
                    ->where('su', '0');

        return view('livewire.admin.admin-users-component', compact('users'))->layout('layouts.base-a');
    }

    /* Create */
    public function create()
    {
        $this->reset(['name']);
        $this->reset(['email']);
        $this->reset(['password']);
    }

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',  
        'password' => 'required',  
    ];

    protected $validationAttributes = [
        'name' => 'Nombre',
        'email' => 'Correo',
        'password' => 'Contraseña'
    ];

    public function save(){
        
        $this->validate();

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->save();    

        User::where('id', $user->id)->update([
            'utype' => "ADM",
        ]);

        $this->reset(['name']);
        $this->reset(['email']);
        $this->reset(['password']);

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
        $this->email = $user->email;
        $this->password = $user->password;
  
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',   
            'email' => "required|string|email|max:255|unique:users,email,$this->user_id",  
            'password' => 'required',   
        ]);

        $user = User::find($this->user_id);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $this->reset(['name']);
        $this->reset(['email']);
        $this->reset(['password']);

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
