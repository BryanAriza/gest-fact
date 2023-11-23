<?php

namespace App\Http\Livewire;
use Livewire\WithPagination;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request; 
use Livewire\Component;
use App\Models\Customer; 
use App\Models\SalesHeader;
use App\Models\TypeDocument; 
use Illuminate\Support\Facades\Auth;

class CustomerController extends Component
{
    use WithPagination;
    public $first_name,$last_name,$id_type,$document,$phone,$email,$selected_id,$selectTypeDoc;
    public $pageTitle, $componentName, $search;
    private $pagination = 20;

    protected $rules = [
        'first_name' => 'required|min:4',
        'last_name' => 'required|min:4',
        'selectTypeDoc' => 'required|not_in:Elegir',
        'document' => "required|min:5|unique:customers,document",
        'phone' => 'required|min:10|regex:/^[^.,]+$/',
        'email' => 'required|unique:customers|email'
    ];

    protected $messages = [
        
        'first_name.required' => 'Ingresa el nombre',
        'first_name.min' => 'El nombre del usuario debe tener al menos 4 caracteres',
        'last_name.required' => 'Ingresa el apellido',
        'last_name.min' => 'El apellido del usuario debe tener al menos 4 caracteres',
        'selectTypeDoc.required' => 'Selecciona el tipo de documento',
        'selectTypeDoc.not_in' => 'Selecciona el tipo de documento distinto a Elegir',
        'document.required' => 'Ingresa la identificación',
        'document.min' => 'La identificación de usuario debe tener al menos 5 caracteres',
        'document.unique' => 'El documento ya existe en sistema',
        'phone.required' => 'Ingresa el télefono',
        'phone.min' => 'El télefono ingresado debe tener al menos 10 caracteres',
        'phone.regex' => 'El télefono no debe contener caracteres especiales',
        'email.required' => 'Ingresa el correo ',
        'email.email' => 'Ingresa un correo válido',
        'email.unique' => 'El email ya existe en sistema',

    ];
    
    public function mount(){

        $this->pageTitle = 'Clientes Registrados';
        $this->componentName = 'Gest-Fact';

    }

    public function paginationView()
	{
		return 'vendor.livewire.bootstrap';
	}

    public function render()
    {

        if (strlen($this->search) > 0)
            $datos = Customer::selectRaw('customers.id, customers.first_name, customers.last_name, type_documents.name_document, customers.document, customers.phone, customers.email')
                                    ->join('type_documents', 'customers.id_type', '=', 'type_documents.id')
                                    ->where('customers.document', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        else
            $datos = Customer::selectRaw('customers.id, customers.first_name, customers.last_name, type_documents.name_document, customers.document, customers.phone, customers.email')
                                    ->join('type_documents', 'customers.id_type', '=', 'type_documents.id')->paginate($this->pagination);                              



        return view('livewire.customers.customer',['datos' => $datos,'typeDoc' => TypeDocument::orderBy('id','asc')->get()])->extends('layouts.theme.app')->section('content');
    }

    //CREACION NUEVO CLIENTE
    public function Store()
	{
		$this->validate($this->rules, $this->messages);

		$customer = Customer::create([
			'first_name' => $this->first_name,
			'last_name' => $this->last_name,
            'id_type' => $this->selectTypeDoc,
			'document' => $this->document,
			'phone' => $this->phone,
			'email' => $this->email,
		]);


		$this->resetUI();
		$this->emit('product-added', 'Cliente Registrado');
	}

    //EDITAR CLIENTE
	public function Edit(Customer $customer)
	{

		$this->selected_id = $customer->id;
		$this->first_name = $customer->first_name;
		$this->last_name = $customer->last_name;
		$this->selectTypeDoc = $customer->id_type;
		$this->document = $customer->document;
        $this->phone = $customer->phone;
		$this->email = $customer->email;

		$this->emit('modal-show', 'Show modal');
	}

    //ACTUALIZAR CLIENTE
	public function Update()
	{
		$rules  = [
            'email' => "required|email|unique:customers,email,{$this->selected_id}",
            'first_name' => 'required|min:4',
            'last_name' => 'required|min:4',
            'selectTypeDoc' => 'required|not_in:Elegir',
            'document' => "required|min:5|unique:customers,document,{$this->selected_id}",
            'phone' => 'required|min:10|regex:/^[^.,]+$/',
		];

		$messages = [
			'first_name.required' => 'Ingresa el nombre',
            'first_name.min' => 'El nombre del usuario debe tener al menos 4 caracteres',
            'last_name.required' => 'Ingresa el apellido',
            'last_name.min' => 'El apellido del usuario debe tener al menos 4 caracteres',
            'selectTypeDoc.required' => 'Selecciona el tipo de documento',
            'selectTypeDoc.not_in' => 'Selecciona el tipo de documento distinto a Elegir',
            'document.required' => 'Ingresa la identificación',
            'document.min' => 'La identificación de usuario debe tener al menos 5 caracteres',
            'document.unique' => 'El documento ya existe en sistema',
            'phone.required' => 'Ingresa el télefono',
            'phone.min' => 'El télefono ingresado debe tener al menos 10 caracteres',
            'phone.regex' => 'El télefono no debe contener caracteres especiales',
            'email.required' => 'Ingresa el correo ',
            'email.email' => 'Ingresa un correo válido',
            'email.unique' => 'El email ya existe en sistema',
		];

		$this->validate($rules, $messages);

		$customer = Customer::find($this->selected_id);

		$customer->update([
			'first_name' => $this->first_name,
			'last_name' => $this->last_name,
			'id_type' => $this->selectTypeDoc,
			'document' => $this->document,
			'phone' => $this->phone,
			'email' => $this->email,
		]);

		$this->resetUI();
		$this->emit('product-updated', 'Producto Actualizado');
	}


    //VACIAR CAMPOS
	public function resetUI()
	{
		$this->first_name = '';
		$this->last_name = '';
		$this->document = '';
		$this->email = '';
		$this->phone = '';
		$this->selectTypeDoc = '';
		$this->selected_id = 0;
		$this->resetValidation();
	}

	protected $listeners = [
		'deleteRow' => 'Destroy'
	];



    //ELIMINAR CLIENTE
	public function Destroy(Customer $customer)
	{
		// Verificar si el cliente tiene ventas pendientes
        $ventasPendientes = $customer->SalesHeaders()->count();

        if ($ventasPendientes > 0) {
            // Si hay ventas pendientes, no permitir la eliminación
            $this->emit('product-not-deleted', 'No puedes eliminar este cliente. Tiene ventas en el sistema.');
        } else {
            // Si no hay ventas pendientes, proceder con la eliminación
            $customer->delete();
            $this->resetUI();
            $this->emit('product-deleted', 'Cliente Eliminado');
        }
	}
}