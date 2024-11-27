<?php

namespace App\Http\Livewire;

use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\SalesDetail;
use Livewire\Component;
use App\Traits\CartTrait;
use App\Models\Product;
use App\Models\Customer;
use App\Models\SalesHeader;
use App\Traits\Utils;
use DB;


class PosController extends Component
{
	use Utils;
	use CartTrait;

	public $total, $itemsQuantity, $efectivo, $change, $documentNum,$first_name,$document,$last_name,$email,$phone,$idCutomer,$id_sale_header,$pdfPath;
    public $loading = false;

    protected $rules = [
        'documentNum' => 'required',
        'document' => 'required',
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required',
        'phone' => 'required'
    ];

    protected $messages = [
        
        'documentNum.required' => 'Ingrese por favor identificacion del cliente',
        'document.required' => 'Ingrese por favor identificacion del cliente',
        'first_name.required' => 'Realice la busqueda por favor',
        'last_name.required' => 'Realice la busqueda por favor',
        'email.required' => 'Realice la busqueda por favor',
        'phone.required' => 'Realice la busqueda por favor',
    ];

	public function mount()
	{
		$this->efectivo = '';
		$this->change = 0;
        $this->documentNum = '';
		$this->total  = Cart::getTotal();
		$this->itemsQuantity = Cart::getTotalQuantity();
	}

	public function render()
	{


		return view('livewire.pos.component', [
			'cart' => Cart::getContent()->sortBy('name')
		])
			->extends('layouts.theme.app')
			->section('content');
	}

    public function updateCustomer(){

        $customer = Customer::where('document', $this->documentNum)->first();

        if ($customer) {
            $this->idCustomer = $customer->id;
            $this->document = $customer->document;
            $this->first_name = $customer->first_name;
            $this->last_name = $customer->last_name;
            $this->email = $customer->email;
            $this->phone = $customer->phone;
        } else {
            $this->first_name = null;
            $this->last_name = null;
            $this->email = null;
            $this->phone = null;
            $this->document = null;
            $this->documentNum = '';
            $this->emit('customer-error', 'Verificar por favor el numero de documento ingresado. Si desea registrar el usuario has clic en Registrar.');
        }
    }

	// agregar efectivo 
	public function ACash()
	{
		$this->change = ($this->efectivo - $this->total);
	}

	// escuchar eventos
	protected $listeners = [
		'scan-code'  =>  'ScanCode',
		'removeItem' => 'removeItem',
		'clearCart'  => 'clearCart',
		'saveSale'   => 'saveSale',
		'refresh' => '$refresh',
		'print-last' => 'printLast',
        'pdf-generated' => 'setPdfPath'
	];
    

    public function setPdfPath($data)
    {

        $this->pdfPath = $data;
    }

	// buscar y agregar producto por escaner y/o manual
	public function ScanCode($barcode, $cant = 1)
	{
		$this->ScanearCode($barcode, $cant);
	}

	// incrementar cantidad item en carrito
	public function increaseQty(Product $product, $cant = 1)
	{
		$this->IncreaseQuantity($product, $cant);
	}

	// actualizar cantidad item en carrito
	public function updateQty(Product $product, $cant = 1)
	{
		if ($cant <= 0)
			$this->removeItem($product->id);
		else
			$this->UpdateQuantity($product, $cant);
	}

	// decrementar cantidad item en carrito
	public function decreaseQty($productId)
	{
		$this->decreaseQuantity($productId);
	}

	// vaciar carrito
	public function clearCart()
	{
		$this->trashCart();
	}


	public function cleanValue($value) 
	 { 
	  return  number_format(str_replace(",","",$value), 2 , '.', ''); 
	 }
	 

	// guardar venta
	public function saveSale()
	{
		$this->loading = true;

		$this->validate($this->rules, $this->messages);

		if ($this->total <= 0) {
			$this->emit('sale-error', 'AGREGA PRODUCTOS A LA VENTA');
			return;
		}
		if ($this->efectivo <= 0) {
			$this->emit('sale-error', 'INGRESA EL EFECTIVO');
			return;
		}
		if ($this->total > $this->efectivo) {
			$this->emit('sale-error', 'EL EFECTIVO DEBE SER MAYOR O IGUAL AL TOTAL');
			return;
		}

		DB::beginTransaction();

		try {
			$fechaActual = date('Y-m-d');

			// Crear el encabezado de la venta
			$sale = SalesHeader::create([
				'id_customer' => $this->idCustomer,
				'id_user' => Auth()->user()->id,
				'total_sale' => $this->total,
				'date_sale' => $fechaActual,
			]);

			if ($sale) {
				// Obtener los productos del carrito
				$items = Cart::getContent();
				$productIds = $items->pluck('id')->toArray();  // Obtener los IDs de los productos en el carrito
				$products = Product::whereIn('id', $productIds)->get()->keyBy('id');  // Obtener todos los productos de una vez

				foreach ($items as $item) {
					// Crear los detalles de la venta
					SalesDetail::create([
						'id_sales_header' => $sale->id,
						'id_product' => $item->id,
						'product_name' => $item->name,
						'cant_product' => $item->quantity,
						'unit_price' => $item->price,
					]);

					// Actualizar el stock en memoria (sin hacer consultas adicionales a la base de datos)
					if (isset($products[$item->id])) {
						$products[$item->id]->stock -= $item->quantity;
						$products[$item->id]->save();  // Guardar la actualización de stock
					}
				}
			}

			DB::commit();

			// Limpiar el carrito y resetear los valores
			Cart::clear();
			$this->efectivo = 0;
			$this->change = 0;
			$this->total = Cart::getTotal();
			$this->itemsQuantity = Cart::getTotalQuantity();
			$this->emit('sale-ok', 'Venta registrada con éxito');

			// Limpiar variables de documentos
			$this->documentNum = '';
			$this->first_name = '';

			// Construir el ticket (si es necesario)
			$ticket = $this->buildTicket($sale);
		} catch (Exception $e) {
			DB::rollback();
			$this->emit('sale-error', $e->getMessage());
		}
	}



	public function printTicket($ventaId)
	{
		return \Redirect::to("print://$ventaId");
	}



	public function buildTicket($sale)
	{
        $id_venta = $sale->id;

		$details = SalesDetail::join('products', 'products.id', 'sales_details.id_product')
			->select('sales_details.*', 'products.product_name')
			->where('sales_details.id_sales_header','=', $id_venta)
			->get();
		
        $detailsArray = json_decode($details, true);
        $idSalesHeader = $detailsArray[0]['id_sales_header'];
     
        $saleHeader = SalesHeader::join('users', 'users.id', 'sales_headers.id_user')
                                ->join('customers', 'customers.id', 'sales_headers.id_customer')
                                ->join('type_documents','type_documents.id', 'customers.id_type')
                                ->select('users.first_name','users.last_name', 'customers.first_name as name_customer', 'customers.last_name as last_customer',
                                'type_documents.name_document','customers.document as docu','sales_headers.*')
                                ->where('sales_headers.id_user', $sale->id_user)
                                ->where('sales_headers.id', $idSalesHeader)
                                ->get();
        //dd($saleHeader);
        // $saleUserName = $saleHeader->id_user; // Accede al nombre del usuario a través de la función de acceso
        
        $r = $saleHeader . $details;

        // Llamada a la función que crea el PDF
        $this->createPdf($saleHeader,$details);
        


		//dd($r);
		return $r;
	}


	public function printLast()
	{
		$lastSale = SalesHeader::latest()->first();

		if ($lastSale)
			$this->emit('print-last-id', $lastSale->id);
	}

    public function createPdf($dataHeader, $dataDetail)
    {
       
        foreach ($dataHeader as $header) {
            $docu = $header->docu;
            $idHea = $header->id;
        }

        $pdf = \PDF::loadView('pdf.facturaPos', ['dataHeader' => $dataHeader,'dataDetail' => $dataDetail]);
        
        // Guardar el PDF en almacenamiento (opcional)
        $pdfPath = public_path('facturas') . '/factura_' .$docu.'_'. date('Y-m-d') .'_'.$idHea. '.pdf';
        $pdf->save($pdfPath);

        $pdfP ='facturas/factura_' .$docu.'_'. date('Y-m-d') .'_'.$idHea. '.pdf';

        $this->emit('pdf-generated', $pdfP);

        $this->loading = false;

        // Redirigir a la ruta con el PDF como parámetro
        return response()->json(['pdfPath' => $pdfPath]);
    }
}