<?php

namespace App\Http\Livewire;
use App\Http\Livewire\Scaner;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Traits\CartTrait;

class SalesController extends Component
{
    use WithPagination;
	use WithFileUploads;
	use CartTrait;


	public function ScanCode($id)
	{
		$this->ScanearCode($id);
		$this->emit('global-msg', "SE AGREGÓ EL PRODUCTO AL CARRITO");
	}

	public $name, $barcode, $cost, $price, $stock, $alerts, $selectCategory, $search, $image, $selected_id, $pageTitle, $componentName;
	private $pagination = 5;


	public function paginationView()
	{
		return 'vendor.livewire.bootstrap';
	}


	public function mount()
	{
		$this->pageTitle = 'Productos disponibles Para Compra';
        $this->componentName = 'Gest-Fact';
		$this->selectCategory = 0;
	}



	public function render()
	{

        $category = Category::all();

		if (strlen($this->search) > 0)
			$products = Product::selectRaw('products.id, products.product_name, products.description, categories.category_name, products.price, products.stock, products.iva')
                                    ->join('categories', 'products.id_category', '=', 'categories.id')
                                    ->where('products.product_name', 'like', '%' . $this->search . '%')
                                    ->where('products.stock', '>', '0')
                                    ->when($this->selectCategory, function ($query){
                                        $query ->where('products.id_category', $this->selectCategory);
                                    })->paginate($this->pagination);
		else
			$products = Product::selectRaw('products.id, products.product_name, products.description, categories.category_name, products.price, products.stock, products.iva')
                                    ->join('categories', 'products.id_category', '=', 'categories.id')
                                    ->where('products.stock', '>', '0')
                                    ->when($this->selectCategory, function ($query){
                                        $query ->where('products.id_category', $this->selectCategory);
                                    })->paginate($this->pagination);




		return view('livewire.sales.sales', [
			'datos' => $products,
			'category' => $category])
			->extends('layouts.theme.app')
			->section('content');
	}

}