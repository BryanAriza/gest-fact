<div class="row sales layout-top-spacing">

    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-header" style="color: #ffffff;">
                    <b>{{$componentName}} | {{$pageTitle}}</b>
                </h4>
            </div>

            <div class="card-body">
                <div class="widget-heading">
                <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <h6 style="font-weight: bold;">{{ __('Estado Agenda') }}</h6>
                            <select wire:model="selectStates" class="form-control">
                                <option value="" selected>== Selecciona un estado ==</option>
                                @foreach ($states as $sta)
                                <option value="{{ $sta->id }}">{{ $sta->description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <h6 style="font-weight: bold;">{{ __('IPS') }}</h6>
                            <select wire:model="selectIps" class="form-control">
                                <option value="" selected>== Selecciona una IPS ==</option>
                                @foreach ($ips as $ip)
                                <option value="{{ $ip->id_ips }}">{{ $ip->name_ips }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                        </div>
                    </div>
                    <br>

                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped mt-1">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <!--<th class="table-th text-white text-center">ID CITA</th>-->
                                <th class="table-th text-white text-center">COD MEDICO</th>
                                <th class="table-th text-white text-center">ESPECIALIDAD</th>
                                <th class="table-th text-white text-center">IPS</th>
                                <th class="table-th text-white text-center">FECHA INICIO CITA</th>
                                <th class="table-th text-white text-center">FECHA FIN CITA</th>
                                <th class="table-th text-white text-center">LOCALIZACION</th>
                                <th class="table-th text-white text-center">REALIZA EL CARGUE</th>
                                <th class="table-th text-white text-center">ESTADO</th>


                            </tr>
                        </thead>
                        <tbody>
                            @if(count($datos) <= 0) <tr>
                                <td class="text-center" colspan="8">NO HAY RESULTADOS</td>
                                </tr>
                                @else
                                @foreach($datos as $datosAgen)
                                <tr>
                                    <!--<td class="text-center">
                                        <h6>{{$datosAgen->appointment_id}}</h6>
                                    </td>-->
                                    <td class="text-center">
                                        <h6>{{$datosAgen->code_med}}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{$datosAgen->speciality}}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{$datosAgen->office}}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{$datosAgen->start}}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{$datosAgen->end}}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{$datosAgen->location}}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{$datosAgen->name}}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{$datosAgen->description}}</h6>
                                    </td>

                                </tr>
                                @endforeach
                                @endif



                                </tr>
                        </tbody>
                    </table>

                </div>
                {{$datos->links()}}
            </div>


        </div>


    </div>

</div>
<style>
.sales .widget {
    position: relative;
    padding: 0px;
    border-radius: 8px;
    border: none;
    background: #fff;
}

.widget-chart-one .widget-heading .tabs a {
    font-size: 19px;
    letter-spacing: 1px;
    font-weight: 600;
    padding: 5px 7px;
    background: #23741e !important;
    color: #fff;
    border-radius: 4px;
    margin-left: 20px;
    margin-top: 5px;
}

.widget-chart-one .widget-heading .tabs a:hover {
    font-size: 19px;
    letter-spacing: 1px;
    font-weight: 600;
    padding: 5px 7px;
    background: #113a0f !important;
    color: #fff;
    border-radius: 4px;
    margin-left: 20px;
}

.widget-chart-one .widget-heading {
    display: block;
    justify-content: space-between;
}

.card-header {
    padding: .75rem 1.25rem;
    margin-bottom: 0;
    background-color: #23741e;
    border-bottom: 1px solid rgba(0, 0, 0, .125);
}

.table>thead>tr>th {
    background: #23741e !important;
    font-weight: 700;
    font-size: 13px;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background-color: #23741e;
    border-color: #23741e;
}

.tbody {
    overflow: auto;
}

.table-responsive {

    /*Firefox*/
    overflow: scroll;
    scrollbar-color: #23741e transparent;
    scrollbar-width: thin;

    /*Webkit*/
    overflow: overlay;
    /*Experimental*/
    scrollbar-gutter: stable;
}

.table-responsive:hover {
    scrollbar-color: rgba(0, 153, 204, 1) transparent;
}

@-moz-document url-prefix() {
    .table-responsive {
        padding-right: 8px;
    }
}

/*Webkit*/
.table-responsive::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

.table-responsive::-webkit-scrollbar-track {
    background-color: transparent;
}

.table-responsive::-webkit-scrollbar-thumb {
    background-color: rgba(0, 153, 204, 0.05);
}

.table-responsive:hover::-webkit-scrollbar-thumb {
    background-color: #23741e;
}
</style>


<script>
/*
	document.addEventListener('DOMContentLoaded', function(){

		window.livewire.on('show-modal', msg =>{
			$('#theModal').modal('show')
		});
		window.livewire.on('category-added', msg =>{
			$('#theModal').modal('hide')
		});
		window.livewire.on('category-updated', msg =>{
			$('#theModal').modal('hide')
		});


	});



	function Confirm(id)
	{	

		swal({
			title: 'CONFIRMAR',
			text: '¿CONFIRMAS ELIMINAR EL REGISTRO?',
			type: 'warning',
			showCancelButton: true,
			cancelButtonText: 'Cerrar',
			cancelButtonColor: '#fff',
			confirmButtonColor: '#3B3F5C',
			confirmButtonText: 'Aceptar'
		}).then(function(result) {
			if(result.value){
				window.livewire.emit('deleteRow', id)
				swal.close()
			}

		})
	}
*/
</script>