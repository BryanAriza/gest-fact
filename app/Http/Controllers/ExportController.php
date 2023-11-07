<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ReportExport;
use App\Models\CitasMas;
use App\Models\Product;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportController extends Controller
{

//REPORTES PDF GENERALES    
    public function reportPdfProduc($selectCategory = null, $search = null){

        $data = [];
        
        $query = DB::table('products')
                        ->join('categories', 'products.id_category', '=', 'categories.id')
                        ->select('products.id',
                                'products.product_name',
                                'products.description',
                                'categories.category_name',
                                'products.price',
                                'products.stock',
                                DB::raw('(products.price * products.stock) AS total'),
                                'products.iva',
                                'products.created_at')
                        ->where(function ($query) use ($selectCategory, $search) {
                            if ($selectCategory > 0) {
                                $query->where('products.id_category', $selectCategory);
                            }
                            if ($search > 0) {
                                $query->where('products.product_name','like', '%' . $search.'%');
                            }
                        });
                            
                        $data = $query->get();
    
                       
                $dataArray = $data->map(function($item) {
    
                    return [
                        $item->id,
                        $item->product_name,
                        $item->description,
                        $item->category_name,
                        $item->price,
                        $item->stock,
                        $item->iva,
                        $item->created_at
                    ];
                })->toArray();
        

        $pdf = PDF::loadView('pdf.reporteProduct', compact('data'));
        return $pdf->stream('Reporte_Productos.pdf'); // visualizar
    }


    public function reportPdfCate($search = null){

        $data = [];
 
        $query =    DB::table('categories')->select('*')
                        ->where(function ($query) use ($search) {
                            if ($search > 0) {
                                $query->where('category_name','like', '%' . $search.'%');
                            }
                        });
                            
                        $data = $query->get();
    
                       
                $dataArray = $data->map(function($item) {
    
                    return [
                        $item->id,
                        $item->category_name,
                        $item->description,
                        $item->created_at
                    ];
                })->toArray();
        

        $pdf = PDF::loadView('pdf.reporteCategory', compact('data'));
        return $pdf->stream('Reporte_Categorias.pdf'); // visualizar
    }



//REPORTES DE EXCEL GENERALES
    public function reportProducts($selectCategory = null, $search = null){
 
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $columns = ['ID','NOMBRE PRODUCTO','DESCRIPCIÓN','NOMBRE DE CATEGORIA','PRECIO UNITARIO','EXISTENCIAS ACTUALES','IVA APLICADO','FECHA DE CREACIÓN PRODUCTO'];
        
            $query = DB::table('products')
                        ->join('categories', 'products.id_category', '=', 'categories.id')
                        ->select('products.id',
                                'products.product_name',
                                'products.description',
                                'categories.category_name',
                                'products.price',
                                'products.stock',
                                'products.iva',
                                'products.created_at')
                        ->where(function ($query) use ($selectCategory, $search) {
                            if ($selectCategory > 0) {
                                $query->where('products.id_category', $selectCategory);
                            }
                            if ($search > 0) {
                                $query->where('products.product_name','like', '%' . $search.'%');
                            }
                        });
                            
                        $data = $query->get();
    
                       
                $dataArray = $data->map(function($item) {
    
                    return [
                        $item->id,
                        $item->product_name,
                        $item->description,
                        $item->category_name,
                        $item->price,
                        $item->stock,
                        $item->iva,
                        $item->created_at
                    ];
                })->toArray();

                //dd($data,$dataArray);

        $sheet->fromArray(array_merge([$columns], $dataArray));

        // $sheet->fromArray(array_merge([$columns], $data->toArray()));

        // Aplicar estilos
        $styleArray = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'cb7400'],
            ],
            
        ];

        $sheet->getStyle('A1:H1')->applyFromArray($styleArray);

        foreach (range('A', 'H') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);

        return response()->stream(
            function () use ($writer) {
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="Reporte Productos Actuales"'. now() .'".xlsx"',
            ]
        );

    }


    public function reportCategory($search = null){
 
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $columns = ['ID','NOMBRE DE LA CATEGORIA','DESCRIPCIÓN','FECHA DE CREACIÓN CATEGORÍA'];
        
            $query = DB::table('categories')->select('*')
                        ->where(function ($query) use ($search) {
                            if ($search > 0) {
                                $query->where('category_name','like', '%' . $search.'%');
                            }
                        });
                            
                        $data = $query->get();
    
                       
                $dataArray = $data->map(function($item) {
    
                    return [
                        $item->id,
                        $item->category_name,
                        $item->description,
                        $item->created_at
                    ];
                })->toArray();

                //dd($data,$dataArray);

        $sheet->fromArray(array_merge([$columns], $dataArray));

        // $sheet->fromArray(array_merge([$columns], $data->toArray()));

        // Aplicar estilos
        $styleArray = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'cb7400'],
            ],
            
        ];

        $sheet->getStyle('A1:D1')->applyFromArray($styleArray);

        foreach (range('A', 'D') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);

        return response()->stream(
            function () use ($writer) {
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="Reporte Categorias Actuales"'. now() .'".xlsx"',
            ]
        );

    }


}