<?php

namespace App\Http\Livewire;


use Spatie\Permission\Models\Role;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\User;
use App\Models\Sale;

class UsersController extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $name, $email, $phone, $status, $image, $password, $selected_id, $fileLoaded, $profile;
public $pageTitle, $componentName, $search;

private $pagination =5;

public function paginationView()
{
    return'vendor.livewire.bootstrap';
}

public function mount()
{
    $this->pageTitle = 'Listado';
    $this->componentName = 'Usuarios';
    $this->status= 'Elegir';
}




    public function render()
    {

        if(strlen($this->search) > 0) 
        $data = User::where('name' , 'like', '%' . $this->search . '%')
        ->select('*')->orderBy('name', 'asc')->paginate($this->pagination);
        else
        $data = User::select('*')->orderBy('name', 'asc')->paginate($this->pagination);
       



        return view('livewire.users.component', [
            'data' => $data, 
            'roles' => Role::orderBy('name', 'asc')->get()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }


    public function resetUI()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->phone = '';
        $this->image = '';
        $this->search = '';
        $this->status = 'Elegir';
        $this->selected_id = 0;
        $this->resetPage();
    }

    public function Edit(User $user)
    {
        $this->selected_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';
        $this->phone = $user->phone;
        $this->profile = $this->profile;
        $this->status = $user->status;

        $this->emit('show-modal', 'open!');
    }

    protected $listeners = [
        'deletedRow' => 'destroy',
        'resetUI' =>'resetUI'
    ];

    public function Store()
    {
        $rules = [
            'name' => "required|min:3",
            'email' => "required|unique:users|email",
            'status' => "required|not_in:Elegir",
            'profile' => "required|not_in:Elegir",
            'password' => "required|min:8|"
        ];
        $message = [
            'name.required' => 'El nombre es requerido',
            'name.min' => 'El nombre debe tener al menos 2 caracteres',
            'email.required' => 'El email es requerido',
            'email.unique' => 'El nombre debe ser unico',

            'status.required' => 'El status es requerido',
            'status.not_in' => 'Elige un status diferente a Elegir',
            'profile.required' => 'El profile es requerido',
            'profile.not_in' => 'Elige un profile diferente a Elegir',
            'name.required' => 'el password es requerido',
            'name.min' => 'la password debe tener al menos 8 caracteres',
            
        ];

        $this->validate($rules, $message);
        $user = User::create(
            [
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email,
                'profile' => $this->profile,
                'status' => $this->status,
                'password' => bcrypt($this->password),
                
            ]);

            if($this->image) {
                $customFileName = uniqid() . '_.' . $this->image->extension();
             $this->image->storeAs('public/users', $customFileName);

             $user->image = $customFileName;
             $user->save();
            }

            $this->resetUI();
            $this->emit('user-added', 'Usuario Registrado');


    }

    public function Update()
    {
        $rules = [
            
            'email' => "required|email|unique:users,email, {{$this->selected_id}}",
            'name' => "required|min:3",
            'status' => "required|not_in:Elegir",
            'profile' => "required|not_in:Elegir",
            'password' => "required|min:8|"
        ];
        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.min' => 'El nombre debe tener al menos 2 caracteres',
            'email.required' => 'El email es requerido',
            'email.unique' => 'El nombre debe ser unico',

            'status.required' => 'El status es requerido',
            'status.not_in' => 'Elige un status diferente a Elegir',
            'profile.required' => 'El profile es requerido',
            'profile.not_in' => 'Elige un profile diferente a Elegir',
            'name.required' => 'el password es requerido',
            'name.min' => 'la password debe tener al menos 8 caracteres',
            
        ];
        $this->validate($rules, $messages);
        
   


    $user = User::find($this->selected_id);
    $user->update(
        [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
            'profile' => $this->profile,
            'password' => bcrypt($this->password) 
        ]
        );

        if($this->image) {
            $customFileName = uniqid() . '_.' . $this->image->extension();
         $this->image->storeAs('public/users', $customFileName);

         $imageTemp = $user->image;


         $user->image = $customFileName;
         $user->save();

         if($imageTemp != null)
         {
             if(file_exists('storage/users/' . $imageTemp))
             {
                 unlink('storage/users/' . $imageTemp);
             }
         }
        }

        $this->resetUI();
        
        $this->emit('user-updated', 'Usuario Actualizado');
    }

    public function Destroy(User $user)
    {   
        if($user) 
        {
            $sales = Sale::where('user_id', $user->id)->count();

            if($sales > 0) {
                $this->emit('user-withsales', 'No es posible eliminar el usuario porque tiene ventas registradas');
            }
            else{
                $user->delete();
                $this->resetUI();
                $this->emit('user-deleted', 'Usuario Eliminado');
            }
        }
    }



}
