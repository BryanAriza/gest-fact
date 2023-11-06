<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request; 
use App\Models\CitasMas;
use App\Models\Ips;
use App\Models\States;
use Illuminate\Support\Facades\DB;
use App\Models\CitasPac;
use Illuminate\Support\Facades\Auth;

class ConsolidadoController extends Component
{
    use WithPagination;
    public $pageTitle, $componentName, $search;
    public $selectConsoli = 0;
    private $pagination = 10;
    
    public function mount(){

        $this->pageTitle = 'Consolidado';
        $this->componentName = 'ESE Centro';
        $this->selectSpe = 0;
        $this->selectIps = 0;
    }

    public function paginationView()
	{
		return 'vendor.livewire.bootstrap';
	}

    public function render()
    {
        $datos = [];
        $ips = Ips::select('id_ips', DB::raw('CONCAT(id_ips, " - ", name_ips) AS name_ips'))
        ->orderBy('id', 'asc')->get();

        $speciality = CitasMas::join('specialities', 'citas_mas.speciality', '=', 'specialities.code')
                                ->select('citas_mas.speciality',DB::raw('CONCAT(citas_mas.speciality, " - ", specialities.speciality) AS speciality_name'))
                                ->groupBy('citas_mas.speciality', 'specialities.speciality')
                                ->get();

        if($this->selectConsoli == 1){

            $datos = CitasPac::join('specialities', 'citas_pacs.speciality_id', '=', 'specialities.CODE')
                                ->select(DB::raw('CONCAT(citas_pacs.speciality_id, " - ", specialities.speciality) AS especialidad'),
                                        DB::raw('COUNT(citas_pacs.id) AS cantidad'))
                                ->groupBy('citas_pacs.speciality_id', 'specialities.speciality')
                                ->paginate($this->pagination);

        }else if($this->selectConsoli == 2){


            if($this->selectIps > 0){
                $datos = DB::table('citas_mas as cm')
                        ->join('states as st', 'cm.status', '=', 'st.id')
                        ->join('specialities as sp', 'cm.speciality', '=', 'sp.code')
                        ->join('ips as ip', 'cm.office_id', '=', 'ip.id_ips')
                        ->when($this->selectIps, function ($query) {
                            // Agregar el where si $this->selectedIps tiene un valor
                            return $query->where('cm.office_id', $this->selectIps);
                        })
                        ->when($this->selectSpe, function ($query) {
                            // Agregar el where si $this->selectedIps tiene un valor
                            return $query->where('cm.speciality', $this->selectSpe);
                        })
                        ->select(
                            DB::raw('CONCAT(cm.office_id, " - ", ip.name_ips) AS name_ips'),
                            DB::raw('CONCAT(cm.speciality, " - ", sp.speciality) AS speciality_name'),
                            DB::raw('SUM(CASE WHEN st.description = "AGENDADO" THEN 1 ELSE 0 END) AS Agendado'),
                            DB::raw('SUM(CASE WHEN st.description = "DISPONIBLE" THEN 1 ELSE 0 END) AS Disponible')
                        )
                        ->whereIn('st.description', ['AGENDADO', 'DISPONIBLE'])
                        ->groupBy('cm.speciality','sp.speciality','cm.office_id','ip.name_ips')
                        ->paginate($this->pagination);
            }else{
                $datos = DB::table('citas_mas as cm')
                        ->join('states as st', 'cm.status', '=', 'st.id')
                        ->join('specialities as sp', 'cm.speciality', '=', 'sp.code') 
                        ->when($this->selectSpe, function ($query) {
                            // Agregar el where si $this->selectedIps tiene un valor
                            return $query->where('cm.speciality', $this->selectSpe);
                        })       
                        ->select(
                            DB::raw('CONCAT(cm.speciality, " - ", sp.speciality) AS speciality_name'),
                            DB::raw('SUM(CASE WHEN st.description = "AGENDADO" THEN 1 ELSE 0 END) AS Agendado'),
                            DB::raw('SUM(CASE WHEN st.description = "DISPONIBLE" THEN 1 ELSE 0 END) AS Disponible')
                        )
                        ->whereIn('st.description', ['AGENDADO', 'DISPONIBLE'])
                        ->groupBy('cm.speciality','sp.speciality')
                        ->paginate($this->pagination);
            }


        }

        return view('livewire.informe.consolidado',['datos' => $datos, 'ips' => $ips, 'speciality' => $speciality])->extends('layouts.theme.app')->section('content');
    }
}
