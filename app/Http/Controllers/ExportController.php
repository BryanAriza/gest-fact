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

        $dateFrom = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
        $dateTo = Carbon::parse(Carbon::now())->format('Y-m-d')   . ' 23:59:59';

        
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
        

        $pdf = PDF::loadView('pdf.reporte', compact('data'));
        return $pdf->stream('Reporte_Productos.pdf'); // visualizar
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


    // public function reportEspeDeta(){
 
       
    //     $spreadsheet = new Spreadsheet();
    //     $sheet = $spreadsheet->getActiveSheet();

    //     $columns = ['TIPO DE DOCUMENTO','DOCUMENTO','NOMBRE COMPLETO','ORGANIZACION','FECHA AUTORIZACION','ESPECIALIDAD','NOMBRE ESPECIALIDAD','PERSONA QUE REALIZA CARGUE','ESTADO PARA AGENDA','ESTADO AFILIADO','CUPS','CONCEPTO'];
    //     $data = CitasPac::select(
    //                             'citas_pacs.type_doc',
    //                             'citas_pacs.document',
    //                             'citas_pacs.full_name',
    //                             'citas_pacs.organization',
    //                             'citas_pacs.date_authorization',
    //                             'citas_pacs.speciality_id',
    //                             'specialities.speciality',
    //                             'users.NAME',
    //                             'states.description AS estado',
    //                             'sta.description AS estado_afiliado',
    //                             'citas_pacs.cups',
    //                             'citas_pacs.concept'
    //                         )
    //                         ->join('users', 'citas_pacs.id_user_upload', '=', 'users.id')
    //                         ->join('states', 'citas_pacs.status', '=', 'states.id')
    //                         ->join('states as sta', 'citas_pacs.afilia_status', '=', 'sta.id')
    //                         ->join('specialities', 'citas_pacs.speciality_id', '=', 'specialities.CODE')
    //                         ->get();




    //     $sheet->fromArray(array_merge([$columns], $data->toArray()));

    //     // Aplicar estilos
    //     $styleArray = [
    //         'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
    //         'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
    //         'borders' => [
    //             'allBorders' => [
    //                 'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //             ],
    //         ],
    //         'fill' => [
    //             'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
    //             'startColor' => ['rgb' => '008000'],
    //         ],
    //     ];

    //     $sheet->getStyle('A1:L1')->applyFromArray($styleArray);

    //     foreach (range('A', 'L') as $column) {
    //         $sheet->getColumnDimension($column)->setAutoSize(true);
    //     }

    //     $writer = new Xlsx($spreadsheet);

    //     return response()->stream(
    //         function () use ($writer) {
    //             $writer->save('php://output');
    //         },
    //         200,
    //         [
    //             'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    //             'Content-Disposition' => 'attachment; filename="Detallado_Cargue_Por_Especialidad"'. now() .'".xlsx"',
    //         ]
    //     );
    // }



    // public function reportCitas( $selectIps = null , $selectSpe = null ){

    //     $spreadsheet = new Spreadsheet();
    //     $sheet = $spreadsheet->getActiveSheet();

    //     $columns = ['IPS','ESPECIALIDAD','NOMBRE ESPECIALIDAD','CANTIDAD AGENDADAS','CANTIDAD DISPONIBLES'];
           
    //         if ($selectIps > 0 & $selectSpe == 0) {

    //             $data = DB::table('citas_mas as cm')
    //                     ->join('states as st', 'cm.status', '=', 'st.id')
    //                     ->join('specialities as sp', 'cm.speciality', '=', 'sp.code')   
    //                     ->join('ips as ip', 'cm.office_id', '=', 'ip.id_ips')
    //                     ->select(
    //                         DB::raw('CONCAT(cm.office_id, " - ", ip.name_ips) AS office'),
    //                         'cm.speciality AS id_speciality',
    //                         'sp.speciality',
    //                         DB::raw('SUM(CASE WHEN st.description = "AGENDADO" THEN 1 ELSE 0 END) AS Agendado'),
    //                         DB::raw('SUM(CASE WHEN st.description = "DISPONIBLE" THEN 1 ELSE 0 END) AS Disponible')
    //                     )
    //                     ->whereIn('st.description', ['AGENDADO', 'DISPONIBLE'])
    //                     ->where('cm.office_id', $selectIps)
    //                     ->groupBy('cm.speciality','sp.speciality','cm.office_id','ip.name_ips')
    //                     ->get();
    //         }else if ($selectSpe > 0 & $selectIps == 0) {

    //             $data = DB::table('citas_mas as cm')
    //                     ->join('states as st', 'cm.status', '=', 'st.id')
    //                     ->join('specialities as sp', 'cm.speciality', '=', 'sp.code')   
    //                     ->join('ips as ip', 'cm.office_id', '=', 'ip.id_ips')
    //                     ->select(
    //                         'cm.speciality AS id_speciality',
    //                         'sp.speciality',
    //                         DB::raw('SUM(CASE WHEN st.description = "AGENDADO" THEN 1 ELSE 0 END) AS Agendado'),
    //                         DB::raw('SUM(CASE WHEN st.description = "DISPONIBLE" THEN 1 ELSE 0 END) AS Disponible')
    //                     )
    //                     ->whereIn('st.description', ['AGENDADO', 'DISPONIBLE'])
    //                     ->where('cm.speciality', $selectSpe)
    //                     ->groupBy('cm.speciality','sp.speciality')
    //                     ->get();

    //         }else if($selectSpe > 0 & $selectIps > 0){

    //             $data = DB::table('citas_mas as cm')
    //                     ->join('states as st', 'cm.status', '=', 'st.id')
    //                     ->join('specialities as sp', 'cm.speciality', '=', 'sp.code')   
    //                     ->join('ips as ip', 'cm.office_id', '=', 'ip.id_ips')
    //                     ->select(
    //                         DB::raw('CONCAT(cm.office_id, " - ", ip.name_ips) AS office'),
    //                         'cm.speciality AS id_speciality',
    //                         'sp.speciality',
    //                         DB::raw('SUM(CASE WHEN st.description = "AGENDADO" THEN 1 ELSE 0 END) AS Agendado'),
    //                         DB::raw('SUM(CASE WHEN st.description = "DISPONIBLE" THEN 1 ELSE 0 END) AS Disponible')
    //                     )
    //                     ->whereIn('st.description', ['AGENDADO', 'DISPONIBLE'])
    //                     ->where('cm.office_id', $selectIps)
    //                     ->where('cm.speciality', $selectSpe)
    //                     ->groupBy('cm.speciality','sp.speciality','cm.office_id','ip.name_ips')
    //                     ->get();
    //         }else if ($selectSpe == 0 & $selectIps == 0){

    //             $data = DB::table('citas_mas as cm')
    //                     ->join('states as st', 'cm.status', '=', 'st.id')
    //                     ->join('specialities as sp', 'cm.speciality', '=', 'sp.code')   
    //                     ->join('ips as ip', 'cm.office_id', '=', 'ip.id_ips')
    //                     ->select(
    //                         'cm.speciality AS id_speciality',
    //                         'sp.speciality',
    //                         DB::raw('SUM(CASE WHEN st.description = "AGENDADO" THEN 1 ELSE 0 END) AS Agendado'),
    //                         DB::raw('SUM(CASE WHEN st.description = "DISPONIBLE" THEN 1 ELSE 0 END) AS Disponible')
    //                     )
    //                     ->whereIn('st.description', ['AGENDADO', 'DISPONIBLE'])
    //                     ->groupBy('cm.speciality','sp.speciality')
    //                     ->get();
    //         }


    //         $dataArray = $data->map(function($item) {
    //             // Si office está vacío o nulo, establecerlo como "General"
    //             $item->office = !empty($item->office) ? $item->office : "GENERAL";

    //             return [
    //                 $item->office,
    //                 $item->id_speciality,
    //                 $item->speciality,
    //                 $item->Agendado,
    //                 $item->Disponible
    //             ];
    //         })->toArray();

    //         $sheet->fromArray(array_merge([$columns], $dataArray));

    //         // Aplicar estilos
    //         $styleArray = [
    //             'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
    //             'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
    //             'borders' => [
    //                 'allBorders' => [
    //                     'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //                 ],
    //             ],
    //             'fill' => [
    //                 'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
    //                 'startColor' => ['rgb' => '008000'],
    //             ],
    //         ];

    //         $sheet->getStyle('A1:E1')->applyFromArray($styleArray);

    //         foreach (range('A', 'E') as $column) {
    //             $sheet->getColumnDimension($column)->setAutoSize(true);
    //         }

    //         $writer = new Xlsx($spreadsheet);

    //         return response()->stream(
    //             function () use ($writer) {
    //                 $writer->save('php://output');
    //             },
    //             200,
    //             [
    //                 'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    //                 'Content-Disposition' => 'attachment; filename="Reporte_Agendas_Consolidado"'. now() .'".xlsx"',
    //             ]
    //         );

    //     }


    //     public function reportCitaDet( $selectIps = null , $selectSpe = null ){

    //         $spreadsheet = new Spreadsheet();
    //         $sheet = $spreadsheet->getActiveSheet();
    
    //         $columns = ['ID CITA','CODIGO DEL MEDICO','ESPECIALIDAD','NOMBRE ESPECIALIDAD','FECHA INICIO CITA','FECHA FINAL CITA','ID SEDE','NOMBRE SEDE','LUGAR CITA','NOMBRE LUGAR CITA','USUARIO REALZA CARGUE AGENDA', 'ESTADO CITA'];
               
    //             $query = DB::table('citas_mas as cm')
    //                 ->join('states as st', 'cm.status', '=', 'st.id')
    //                 ->join('users as us', 'cm.id_user_upload', '=', 'us.id')   
    //                 ->join('ips as ip', 'cm.office_id', '=', 'ip.id_ips')
    //                 ->select(
    //                     'cm.appointment_id',
    //                     'cm.code_med',
    //                     'cm.speciality',
    //                     'cm.speciality_name',
    //                     'cm.start',
    //                     'cm.end',
    //                     'cm.office_id',
    //                     'ip.name_ips',
    //                     'cm.location_id',
    //                     'cm.location',
    //                     'us.name',
    //                     'st.description'
    //                 )
    //                 ->where(function ($query) use ($selectIps, $selectSpe) {
    //                     if ($selectIps > 0) {
    //                         $query->where('cm.office_id', $selectIps);
    //                     }
    //                     if ($selectSpe > 0) {
    //                         $query->where('cm.speciality', $selectSpe);
    //                     }
    //                 });
                
    
    //             $data = $query->get();
    
    //             $dataArray = $data->map(function($item) {
    
    //                 return [
    //                     $item->appointment_id,
    //                     $item->code_med,
    //                     $item->speciality,
    //                     $item->speciality_name,
    //                     $item->start,
    //                     $item->end,
    //                     $item->office_id,
    //                     $item->name_ips,
    //                     $item->location_id,
    //                     $item->location,
    //                     $item->name,
    //                     $item->description
    //                 ];
    //             })->toArray();

    //             // dd($dataArray);
    //             $sheet->fromArray(array_merge([$columns], $dataArray));
    
    //             // Aplicar estilos
    //             $styleArray = [
    //                 'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
    //                 'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
    //                 'borders' => [
    //                     'allBorders' => [
    //                         'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //                     ],
    //                 ],
    //                 'fill' => [
    //                     'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
    //                     'startColor' => ['rgb' => '008000'],
    //                 ],
    //             ];
    
    //             $sheet->getStyle('A1:L1')->applyFromArray($styleArray);
    
    //             foreach (range('A', 'L') as $column) {
    //                 $sheet->getColumnDimension($column)->setAutoSize(true);
    //             }
    
    //             $writer = new Xlsx($spreadsheet);
    
    //             return response()->stream(
    //                 function () use ($writer) {
    //                     $writer->save('php://output');
    //                 },
    //                 200,
    //                 [
    //                     'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    //                     'Content-Disposition' => 'attachment; filename="Reporte_Agendas_Detallado"'. now() .'".xlsx"',
    //                 ]
    //             );
    
    //         }
}