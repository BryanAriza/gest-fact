<?php

namespace App\Http\Livewire;
use App\Models\TypeDocument;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;


class UsersController extends Component
{

    use WithPagination;
    use WithFileUploads;

    public $first_name,$last_name,$rol,$id_type,$document,$phone,$email,$password,$status,$image,$selected_id,$selectTypeDoc;
    public $pageTitle, $componentName, $search;
    private $pagination = 10;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle ='Listado';
        $this->componentName ='Usuarios';
        $this->status ='Elegir';
    }


    public function render()
    {       
        if(strlen($this->search) > 0)
            $data = User::where('document', 'like', '%' . $this->search . '%')
        ->select('*')->orderBy('last_name','asc')->paginate($this->pagination);
        else
           $data = User::select('*')->orderBy('last_name','asc')->paginate($this->pagination);


       return view('livewire.users.component',[
        'data' => $data,
        'roles' => Role::orderBy('name','asc')->get(),
        'typeDoc' => TypeDocument::orderBy('id','asc')->get()
    ])
       ->extends('layouts.theme.app')
       ->section('content');
   }

   public function resetUI()
   {
    $this->first_name ='';
    $this->last_name='';
    $this->rol='';
    $this->id_type='';
    $this->document='';
    $this->phone='';
    $this->email ='';
    $this->password ='';
    $this->selectTypeDoc =0;
    $this->status ='Elegir';
    $this->selected_id =0;
    $this->resetValidation();
    $this->resetPage();
}


    public function edit(User $user)
    {
        $this->selected_id = $user->id;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->rol = $user->rol;
        $this->selectTypeDoc = $user->id_type;
        $this->document = $user->document;
        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->status = $user->status;
        $this->password ='';

        $this->emit('show-modal','open!');
    
    }


    protected $listeners =[
        'deleteRow' => 'destroy',
        'resetUI' => 'resetUI'

    ];


    public function Store()
    {
    $rules =[
        'first_name' => 'required|min:4',
        'last_name' => 'required|min:4',
        'rol' => 'required|not_in:Elegir',
        'selectTypeDoc' => 'required|not_in:Elegir',
        'document' => 'required|min:5',
        'phone' => 'required|min:10|regex:/^[^.,]+$/',
        'email' => 'required|unique:users|email',
        'status' => 'required|not_in:Elegir',
        'password' => 'required|min:3'
    ];

    $messages =[
        'first_name.required' => 'Ingresa el nombre',
        'first_name.min' => 'El nombre del usuario debe tener al menos 4 caracteres',
        'last_name.required' => 'Ingresa el apellido',
        'last_name.min' => 'El apellido del usuario debe tener al menos 4 caracteres',
        'rol.required' => 'Selecciona el perfil/role del usuario',
        'rol.not_in' => 'Selecciona un perfil/role distinto a Elegir',
        'selectTypeDoc.required' => 'Selecciona el tipo de documento',
        'selectTypeDoc.not_in' => 'Selecciona el tipo de documento distinto a Elegir',
        'document.required' => 'Ingresa la identificación',
        'document.min' => 'La identificación de usuario debe tener al menos 5 caracteres',
        'phone.required' => 'Ingresa el télefono',
        'phone.min' => 'El télefono ingresado debe tener al menos 10 caracteres',
        'phone.regex' => 'El télefono no debe contener caracteres especiales',
        'email.required' => 'Ingresa el correo ',
        'email.email' => 'Ingresa un correo válido',
        'email.unique' => 'El email ya existe en sistema',
        'status.required' => 'Selecciona el estatus del usuario',
        'status.not_in' => 'Selecciona el estatus',
        'password.required' => 'Ingresa el password',
        'password.min' => 'El password debe tener al menos 3 caracteres'
    ];

    $this->validate($rules, $messages);

    $user = User::create([
        'first_name' => $this->first_name,
        'last_name' => $this->last_name,
        'rol' => $this->rol,
        'id_type' => $this->selectTypeDoc,
        'document' => $this->document,
        'phone' => $this->phone,
        'email' => $this->email,
        'status' => $this->status,
        'password' => bcrypt($this->password)
    ]);

    $user->syncRoles($this->rol);

    if($this->image) 
    {
        $customFileName = uniqid() . ' _.' . $this->image->extension();
        $this->image->storeAs('public/users', $customFileName);
        $user->image = $customFileName;
        $user->save();
    }

    $this->resetUI();
    $this->emit('user-added','Usuario Registrado');

    }

    public function Update()
    {

        $rules =[
            'email' => "required|email|unique:users,email,{$this->selected_id}",
            'first_name' => 'required|min:4',
            'last_name' => 'required|min:4',
            'rol' => 'required|not_in:Elegir',
            'selectTypeDoc' => 'required|not_in:Elegir',
            'document' => 'required|min:5',
            'phone' => 'required|min:10',
            'status' => 'required|not_in:Elegir',
            'password' => 'required|min:3'
        ];

        $messages =[
            'first_name.required' => 'Ingresa el nombre',
            'first_name.min' => 'El nombre del usuario debe tener al menos 4 caracteres',
            'last_name.required' => 'Ingresa el apellido',
            'last_name.min' => 'El apellido del usuario debe tener al menos 4 caracteres',
            'rol.required' => 'Selecciona el perfil/role del usuario',
            'rol.not_in' => 'Selecciona un perfil/role distinto a Elegir',
            'selectTypeDoc.required' => 'Selecciona el tipo de documento',
            'selectTypeDoc.not_in' => 'Selecciona el tipo de documento distinto a Elegir',
            'document.required' => 'Ingresa la identificación',
            'document.min' => 'La identificación de usuario debe tener al menos 5 caracteres',
            'phone.required' => 'Ingresa el télefono',
            'phone.min' => 'El télefono ingresado debe tener al menos 10 caracteres',
            'email.required' => 'Ingresa el correo ',
            'email.email' => 'Ingresa un correo válido',
            'email.unique' => 'El email ya existe en sistema',
            'status.required' => 'Selecciona el estatus del usuario',
            'status.not_in' => 'Selecciona el estatus',
            'password.required' => 'Ingresa el password',
            'password.min' => 'El password debe tener al menos 3 caracteres'
        ];

        $this->validate($rules, $messages);

        $user = User::find($this->selected_id);
        $user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'rol' => $this->rol,
            'id_type' => $this->selectTypeDoc,
            'document' => $this->document,
            'phone' => $this->phone,
            'email' => $this->email,
            'status' => $this->status,
            'password' => strlen($this->password) > 0 ? bcrypt($this->password) : $user->password
        ]);
        
        $user->syncRoles($this->rol);


        if($this->image) 
        {
            $customFileName = uniqid() . ' _.' . $this->image->extension();
            $this->image->storeAs('public/users', $customFileName);
            $imageTemp = $user->image;

            $user->image = $customFileName;
            $user->save();

            if($imageTemp !=null) 
            {
                if(file_exists('storage/users/' . $imageTemp)) {
                    unlink('storage/users/' . $imageTemp);
                }
            }


        }

        $this->resetUI();
        $this->emit('user-updated','Usuario Actualizado');

    }


    public function destroy(User $user)
    {
    if($user) {
        
            $user->delete();
            $this->resetUI();
            $this->emit('user-deleted','Usuario Eliminado');
        }
    }
}