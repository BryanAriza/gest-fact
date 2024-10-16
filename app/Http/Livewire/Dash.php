<?php

namespace App\Http\Livewire;


use DateTime;
use App\Models\SalesHeader;
use Livewire\Component;
use App\Models\SalesDetail;
use Illuminate\Support\Facades\DB;

class Dash extends Component
{

    public $salesByMonth_Data = [], $year, $listYears = [], $top5Data = [], $weekSales_Data = [];

    public function mount()
    {
        $this->year = date('Y');
    }

    public function render()
    {

        $this->getWeekSales();
        $this->getTop5();
        $this->getSalesMonth();

        return view('livewire.dash.component')->extends('layouts.theme.app')
            ->section('content');
    }

    public function getTop5()
    {
        $this->top5Data = SalesDetail::join('products as p', 'sales_details.id_product', 'p.id')
            ->select(
                DB::raw("p.product_name AS product, SUM(sales_details.cant_product * sales_details.unit_price)AS total"),
            )->whereYear("sales_details.created_at", $this->year)
            ->groupBy('p.product_name')
            ->orderBy(DB::raw("SUM(sales_details.cant_product * sales_details.unit_price) "), 'desc')
            ->get()->take(5)->toArray();

        $contDif = (5 - count($this->top5Data));
        if ($contDif > 0) {
            for ($i = 1; $i <= $contDif; $i++) {
                array_push($this->top5Data, ["product" => "-", 'total' => 0]);
            }
        }
    }

    public function getWeekSales()
    {
        $dt = new DateTime();
        $startDate = null;
        $finishDate = null;

        for ($d = 1; $d <= 7; $d++) {

            $dt->setISODate($dt->format('o'), $dt->format('W'), $d);

            $startDate = $dt->format('Y-m-d') . ' 00:00:00';
            $finishDate = $dt->format('Y-m-d') . ' 23:59:59';
            $wsale = SalesHeader::whereBetween('created_at', [$startDate, $finishDate])->sum('total_sale');

            array_push($this->weekSales_Data, $wsale);
        }
    }

    public function getSalesMonth()
    {
        $this->sales = [];

        $salesByMonth = DB::select(
            DB::raw("SELECT coalesce(total,0)as total
                FROM (SELECT 'january' AS month UNION SELECT 'february' AS month UNION SELECT 'march' AS month UNION SELECT 'april' AS month UNION SELECT 'may' AS month UNION SELECT 'june' AS month UNION SELECT 'july' AS month UNION SELECT 'august' AS month UNION SELECT 'september' AS month UNION SELECT 'october' AS month UNION SELECT 'november' AS month UNION SELECT 'december' AS month ) m LEFT JOIN (SELECT MONTHNAME(created_at) AS MONTH, COUNT(*) AS orders, SUM(total_sale)AS total 
                FROM sales_headers WHERE year(created_at)= $this->year
                GROUP BY MONTHNAME(created_at),MONTH(created_at) 
                ORDER BY MONTH(created_at)) c ON m.MONTH =c.MONTH;")
        );

        foreach ($salesByMonth as $sale) {
            array_push($this->salesByMonth_Data, $sale->total);
        }
    }
}
