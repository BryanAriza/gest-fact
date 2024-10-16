<?php

namespace App\Http\Livewire;
use Livewire\WithPagination;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request; 
use Livewire\Component;
use App\Models\Product; 
use App\Models\Category;
use App\Models\ProductLog;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Component
{
    use WithPagination;
    public $pageTitle, $componentName, $search, $selected_id, $category_name, $description;
    private $pagination = 20;

    protected $rules = [
        'category_name' => 'required|min:3|regex:/^[A-Za-z\s]+$/',
        'description' => 'required|regex:/^[A-Za-z\s]+$/',
    ];

    protected $messages = [
        
        'category_name.required' => 'Nombre de la categoría requerido',
        'category_name.min' => 'El nombre de la categoría debe tener al menos 3 caracteres',
        'category_name.regex' => 'El campo Nombre de la categoría solo puede contener letras y espacios.',
        'description.required' => 'Descripción de la categoría requerido',
        'description.regex' => 'El campo Descripción de la categoría solo puede contener letras y espacios.'
    ];
    
    public function mount(){

        $this->pageTitle = 'Categorias Existentes';
        $this->componentName = 'Gest-Fact';

    }

    public function paginationView()
	{
		return 'vendor.livewire.bootstrap';
	}

    public function render()
    {

        if (strlen($this->search) > 0)
            $datos = Category::selectRaw('*')
                                    ->where('category_name', 'like', '%' . $this->search . '%')
                                    ->paginate($this->pagination);
        else
            $datos = Category::selectRaw('*')->paginate($this->pagination);           

        return view('livewire.categories.categories',['datos' => $datos])->extends('layouts.theme.app')->section('content');
    }

    //CREACION NUEVO PRODUCTO
    public function Store()
	{

		$this->validate($this->rules, $this->messages);

		$product = Category::create([
			'category_name' => $this->category_name,
			'description' => $this->description,
		]);

		$this->resetUI();
		$this->emit('product-added', 'Producto Registrado');
	}

    //EDITAR PRODUCTO
	public function Edit(Category $category)
	{

		$this->selected_id = $category->id;
		$this->category_name = $category->category_name;
		$this->description = $category->description;

		$this->emit('modal-show', 'Show modal');
	}

    //ACTUALIZAR PRODUCTO
	public function Update()
	{
		$rules  = [
            'category_name' => "required|min:3|unique:categories,id,{$this->selected_id}|regex:/^[A-Za-z\s]+$/",
            'description' => 'required|regex:/^[A-Za-z\s]+$/',
		];

		$messages = [
			'category_name.required' => 'Nombre de la categoría requerido',
            'category_name.min' => 'El nombre de la categoría debe tener al menos 3 caracteres',
            'category_name.regex' => 'El campo Nombre de la categoría solo puede contener letras y espacios.',
            'description.required' => 'Descripción de la categoría requerido',
            'description.regex' => 'El campo Descripción de la categoría solo puede contener letras y espacios.'
		];

		$this->validate($rules, $messages);

		$category = Category::find($this->selected_id);

		$category->update([
			'category_name' => $this->category_name,
			'description' => $this->description,
		]);

		$this->resetUI();
		$this->emit('product-updated', 'Producto Actualizado');
	}


    //VACIAR CAMPOS
	public function resetUI()
	{
		$this->category_name = '';
		$this->description = '';
        $this->selected_id = 0;
		$this->resetValidation();
	}

	protected $listeners = [
		'deleteRow' => 'Destroy'
	];



    //ELIMINAR PRODUCTO
	public function Destroy(Category $category)
	{
		// Verificar si la categoría está asociada a algún producto
		$productosAsociados = $category->products()->count();

		if ($productosAsociados > 0) {
			// Si hay productos asociados, no permitir la eliminación
			$this->emit('product-not-deleted', 'No puedes eliminar esta categoría. Está asociada a productos.');
		} else {
			// Si no hay productos asociados, proceder con la eliminación
			$category->delete();
			$this->resetUI();
			$this->emit('product-deleted', 'Categoría Eliminada');
		}
	}
}
