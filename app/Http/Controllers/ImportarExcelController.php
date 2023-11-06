<?php

namespace App\Http\Controllers;

use App\Imports\PacientesImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;



class ImportarExcelController extends Controller
{

    public $loading = false;

    public function mount()
	{
		$this->pageTitle = 'Agendamiento Masivo';
        $this->componentName = 'ESE Centro';
		
		
	}

    public function index()
    {
        return view('livewire.importar.import')
        ->extends('layouts.theme.app')
        ->with('loading', $this->loading)
		->section('content');;
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->componentName = 'Importar Pacientes';

        $rules = [
            'import_file' => 'required|mimes:xlsx'
            
        ];
        $message = [
            'import_file.required' => 'Adjunte un documento por favor'
        ];    

        $request->validate($rules,$message);

        $this->loading = true;

        try{


            $file = $request->file('import_file');
            
            $this->loading = false;

            Excel::import(new PacientesImport, $file);

            return redirect()->route('importar.index')->with('success', ' Documento importado correctamente.');
            

        }catch(Throwable $e){
            

            return redirect()->route('importar.index')->with('error', ' Error durante la importación del documento. Por favor verifique el archivo.');
        }
    }

    
}
