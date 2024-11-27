<?php

namespace App\Http\Livewire;

use App\Models\SalesDetail;
use Illuminate\Support\Facades\DB;
use App\Models\SalesHeader;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;

class ReportVentasController extends Component
{
    use WithPagination;
    public $result = [];
    public $product_name, $cant_product, $name_document, $unit_price, $total_sale, $date_sale, $id_header, $user_name, $startDate, $endDate, $search, $customer_name, $document, $phone, $email, $category_name;

    public function mount()
    {
        $this->pageTitle = 'Reporte Ventas Realizadas';
        $this->componentName = 'Gest-Fact';
        $this->startDate = null;
        $this->endDate = null;
        $this->search = null;
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {

        $query = SalesHeader::with(['customer.typeDocument', 'user'])
            ->join('customers as c', 'sales_headers.id_customer', '=', 'c.id')
            ->join('users as u', 'sales_headers.id_user', '=', 'u.id')
            ->join('type_documents as t', 'c.id_type', '=', 't.id')
            ->selectRaw('
                sales_headers.id,
                CONCAT(c.first_name, " ", c.last_name) as customer_name,
                t.name_document,
                c.document,
                CONCAT(u.first_name, " ", u.last_name) as user,
                u.rol,
                sales_headers.total_sale,
                sales_headers.date_sale
            ');

        if (!is_null($this->startDate)) {
            $query->whereDate('sales_headers.date_sale', '>=', Carbon::parse($this->startDate));
        }

        if (!is_null($this->endDate)) {
            $query->whereDate('sales_headers.date_sale', '<=', Carbon::parse($this->endDate));
        }
        if (!empty($this->search)) {
            $query->where('c.document', 'LIKE', '%' . $this->search . '%');
        }

        $datos = $query->paginate(10);

        $totalVentas = $query->sum('sales_headers.total_sale');
        // dd($datos);
        return view('livewire.reports.component', ['datos' => $datos, 'totalVentas' => $totalVentas])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function updated($field)
    {
        if ($field == 'startDate' || $field == 'endDate') {
            $this->resetPage();
        }
    }

    public function showSaleDetails($salesId)
    {
        $this->result = DB::select("
        SELECT DISTINCT
            sh.id,
            CONCAT(cu.first_name, ' ', cu.last_name) AS customer_name,
            tp.name_document,
            cu.document,
            cu.phone,
            cu.email,
            c.category_name,
            sd.product_name,
            sd.cant_product,
            sd.unit_price,
            sh.total_sale,
            sh.date_sale,
            CONCAT(u.first_name, ' ', u.last_name) AS user
        FROM
            sales_details sd
            INNER JOIN sales_headers sh ON sd.id_sales_header = sh.id
            INNER JOIN products p ON sd.id_product = p.id
            INNER JOIN categories c ON p.id_category = c.id
            INNER JOIN customers cu ON sh.id_customer = cu.id
            INNER JOIN users u ON sh.id_user = u.id
            INNER JOIN type_documents tp ON cu.id_type = tp.id
        WHERE
            sh.id = ?", [$salesId]);

        if ($this->result) {

            $this->id_header = $this->result[0]->id;
            $this->customer_name = $this->result[0]->customer_name;
            $this->document = $this->result[0]->document;
            $this->name_document = $this->result[0]->name_document;
            $this->phone = $this->result[0]->phone;
            $this->email = $this->result[0]->email;
            $this->category_name = $this->result[0]->category_name;
            $this->product_name = $this->result[0]->product_name;
            $this->cant_product = $this->result[0]->cant_product;
            $this->unit_price = $this->result[0]->unit_price;
            $this->total_sale = $this->result[0]->total_sale;
            $this->date_sale = $this->result[0]->date_sale;
            $this->user_name = $this->result[0]->user;
        }
    
        $this->emit('modal-show', 'Show modal');
    }

}
