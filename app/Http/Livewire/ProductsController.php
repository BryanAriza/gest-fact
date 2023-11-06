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

class ProductsController extends Component
{
    use WithPagination;
    public $pageTitle, $componentName, $search, $selected_id, $product_name, $description, $price, $stock, $iva, $category_name;
    private $pagination = 20;

    protected $rules = [
        'product_name' => 'required|min:3|regex:/^[A-Za-z\s]+$/',
        'description' => 'required|regex:/^[A-Za-z\s]+$/',
        'price' => 'required|numeric|gte:0',
        'stock' => 'required|numeric|gte:0',
        'iva' => 'required|numeric|gte:0',
        'category_name' => 'required|not_in:0'
    ];

    protected $messages = [
        
        'product_name.required' => 'Nombre del producto requerido',
        'product_name.min' => 'El nombre del producto debe tener al menos 3 caracteres',
        'product_name.regex' => 'El campo Nombre del Producto solo puede contener letras y espacios.',
        'description.required' => 'Descripción del producto requerido',
        'description.min' => 'La descripción del producto debe tener al menos 3 caracteres',
        'description.regex' => 'El campo Descripción del Producto solo puede contener letras y espacios.',
        'price.required' => 'El precio es requerido',
        'price.numeric' => 'El precio es solo numerico',
        'price.gte' => 'El precio no debe contener caracteres especiales',
        'stock.required' => 'Las existencias son requeridas',
        'stock.numeric' => 'Las existencias deben ser solo numerico',
        'stock.gte' => 'Las existencias no deben contener caracteres especiales',
        'iva.required' => 'El iva es requerido',
        'iva.numeric' => 'El iva es solo numerico',
        'iva.gte' => 'El iva no debe contener caracteres especiales',
        'category_name.required' => 'Categoria del es requerida.',
        'category_name.not_in' => 'Elige un nombre de categoría diferente de Elegir',
    ];
    
    public function mount(){

        $this->pageTitle = 'Productos Existentes';
        $this->componentName = 'Gest-Fact';
        $this->selectCategory = 0;

    }

    public function paginationView()
	{
		return 'vendor.livewire.bootstrap';
	}

    public function render()
    {

        $category = Category::all();

        if (strlen($this->search) > 0)
            $datos = Product::selectRaw('products.id, products.product_name, products.description, categories.category_name, products.price, products.stock, products.iva')
                                    ->join('categories', 'products.id_category', '=', 'categories.id')
                                    ->where('products.product_name', 'like', '%' . $this->search . '%')
                                    ->when($this->selectCategory, function ($query){
                                        $query ->where('products.id_category', $this->selectCategory);
                                    })->paginate($this->pagination);
        else
            $datos = Product::selectRaw('products.id, products.product_name, products.description, categories.category_name, products.price, products.stock, products.iva')
                                    ->join('categories', 'products.id_category', '=', 'categories.id')
                                    ->when($this->selectCategory, function ($query){
                                        $query ->where('products.id_category', $this->selectCategory);
                                    })->paginate($this->pagination);                              



        return view('livewire.products.products',['datos' => $datos, 'category' => $category])->extends('layouts.theme.app')->section('content');
    }

    //CREACION NUEVO PRODUCTO
    public function Store()
	{

        $fechaActual = date('Y-m-d');

		$this->validate($this->rules, $this->messages);

		$product = Product::create([
			'product_name' => $this->product_name,
			'description' => $this->description,
            'id_category' => $this->category_name,
			'price' => $this->price,
			'stock' => $this->stock,
			'iva' => $this->iva,
		]);

        ProductLog::create([
            'id_product' => $product->id,
            'product_name' => $product->product_name,
            'id_category' => $product->id_category,
            'price' => $product->price,
            'stock' => $product->stock,
            'iva' => $product->iva,
            'date_carga' => $fechaActual,
            
        ]);


		$this->resetUI();
		$this->emit('product-added', 'Producto Registrado');
	}

    //EDITAR PRODUCTO
	public function Edit(Product $product)
	{

		$this->selected_id = $product->id;
		$this->product_name = $product->product_name;
		$this->description = $product->description;
		$this->price = $product->price;
		$this->stock = $product->stock;
        $this->iva = $product->iva;
		$this->category_name = $product->id_category;

		$this->emit('modal-show', 'Show modal');
	}

    //ACTUALIZAR PRODUCTO
	public function Update()
	{
		$rules  = [
			'product_name' => "required|min:3|unique:products,id,{$this->selected_id}|regex:/^[A-Za-z\s]+$/",
			'description' => 'required|regex:/^[A-Za-z\s]+$/',
            'price' => 'required|numeric|gte:0',
            'stock' => 'required|numeric|gte:0',
            'iva' => 'required|numeric|gte:0',
            'category_name' => 'required|not_in:0'
		];

		$messages = [
			'product_name.required' => 'Nombre del producto requerido',
            'product_name.min' => 'El nombre del producto debe tener al menos 3 caracteres',
            'product_name.regex' => 'El campo Nombre del Producto solo puede contener letras y espacios.',
            'description.required' => 'Descripción del producto requerido',
            'description.min' => 'La descripción del producto debe tener al menos 3 caracteres',
            'description.regex' => 'El campo Descripción del Producto solo puede contener letras y espacios.',
            'price.required' => 'El precio es requerido',
            'price.numeric' => 'El precio es solo numerico',
            'price.gte' => 'El precio no debe contener caracteres especiales',
            'stock.required' => 'Las existencias son requeridas',
            'stock.numeric' => 'Las existencias deben ser solo numerico',
            'stock.gte' => 'Las existencias no deben contener caracteres especiales',
            'iva.required' => 'El iva es requerido',
            'iva.numeric' => 'El iva es solo numerico',
            'iva.gte' => 'El iva no debe contener caracteres especiales',
            'category_name.required' => 'Categoria del es requerida.',
            'category_name.not_in' => 'Elige un nombre de categoría diferente de Elegir',
		];

		$this->validate($rules, $messages);

		$product = Product::find($this->selected_id);

		$product->update([
			'product_name' => $this->product_name,
			'description' => $this->description,
			'id_category' => $this->category_name,
			'price' => $this->price,
			'stock' => $this->stock,
			'iva' => $this->iva,
		]);

		$this->resetUI();
		$this->emit('product-updated', 'Producto Actualizado');
	}


    //VACIAR CAMPOS
	public function resetUI()
	{
		$this->product_name = '';
		$this->description = '';
		$this->price = '';
		$this->stock = '';
		$this->iva = '';
		$this->category_name = '0';
		$this->selected_id = 0;
		$this->resetValidation();
	}

	protected $listeners = [
		'deleteRow' => 'Destroy'
	];



    //ELIMINAR PRODUCTO
	public function Destroy(Product $product)
	{
		$product->delete();

		$this->resetUI();
		$this->emit('product-deleted', 'Producto Eliminado');
	}
}
