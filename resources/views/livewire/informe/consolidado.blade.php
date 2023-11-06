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
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h6 style="font-weight: bold;">{{ __('Seleccione Tipo de Consolidado') }}</h6>
                            <select wire:model="selectConsoli" class="form-control">
                                <option value="" selected>== Selecciona un estado ==</option>
                                <option value="1">CANTIDAD DE CARGUE POR ESPECIALIDAD</option>
                                <option value="2">CANTIDAD DE CITAS CON ASIGNACIÓN O SIN ASIGNACIÓN</option>

                            </select>
                        </div>

                    </div>
                    <br>

                </div>


                @if($selectConsoli == 1)
                    @include('livewire.informe.componentEspe')
                @elseif($selectConsoli == 2)
                    @include('livewire.informe.componentAgen')
                @endif



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