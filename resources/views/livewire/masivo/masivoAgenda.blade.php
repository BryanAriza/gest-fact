<div class="row sales layout-top-spacing">

    <div class="col-sm-8 mx-auto text-center">
        <div class="widget widget-chart-one">
            <div class="widget-heading text-left">
                <h4 class="card-header" style="color: #ffffff;">
                    <b>{{$componentName}} | {{$pageTitle}}</b>
                </h4>
            </div>

            <div class="card-body">
                <div class="card-body">

                    <strong>
                        <strong>
                            <h5 style="text-align:center">TENER EN CUENTA</h5>
                            <br>
                        </strong>
                        <p>- LAS AGENDAS REGISTRADAS CORRESPONDEN AL CARGUE REALIZADO PREVIAMENTE POR PARTE DEL GESTOR.
                        </p>
                        <br>
                    </strong>
                    <div class="row">

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group text-left">
                                <p><strong>Agenda Disponible Para Cargue Masivo</strong></p>
                                <select wire:model="selectedAgend" class="form-control">
                                    <option value="0">-- Seleccione una opción --</option>
                                    @foreach($data_mas as $mas)
                                    <option value="{{$mas->speciality}}">{{$mas->name_speciality}}</option>
                                    @endforeach
                                </select>
                                @error('selectedAgend') <span class="text-danger er">{{ $message}}</span>@enderror
                            </div>
                        </div>


                        @if($selectedAgend > 0)
                        @csrf
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group text-left">
                                <p><strong>Cantidad de Pacientes Disponibles Para Agenda</strong></p>
                                <input type="number" value="{{$total_pac}}" class="form-control" placeholder=""
                                    disabled>

                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group text-left">
                                <p><strong>Cantidad de Agendas Disponibles</strong></p>
                                <input type="number" value="{{$total_agen}}" class="form-control" placeholder=""
                                    disabled>

                            </div>
                        </div>
                        
                        @endif



                    </div>
                </div>
                
                <div class="widget-heading">
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group text-left">
                            <button id="boton" type="button" class="btn btn-primary" data-toggle="modal" onclick=""
                                wire:click="agenMasi({{$user}},{{$total_pac}},{{$total_agen}})">Realizar Cargue Masivo</button>
                        </div>
                    </div>

                </div>
                <div class="alert alert-info text-center mb-0" role="alert" wire:loading wire:target="agenMasi">
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Cargando...</span>
                    </div>
                    Cargando...
                    <!-- Muestra un mensaje de carga mientras se está realizando la consulta -->
                </div>

                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                        <style>
                        svg {
                            fill: #22d11f
                        }
                        </style>
                        <path
                            d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z" />
                    </svg>
                    {{ session('success') }}
                </div>
                @elseif(session('error'))
                <div class="alert alert-danger" role="alert"><svg xmlns="http://www.w3.org/2000/svg" height="1em"
                        viewBox="0 0 512 512">
                        <style>
                        svg {
                            fill: #df1111
                        }
                        </style>
                        <path
                            d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z" />
                    </svg>
                    {{ session('error') }}
                </div>
                @endif

            </div>

        </div>


    </div>


</div>

</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function alertInfo() {

    const btncambio = document.getElementById("boton");
    btncambio.disabled = true;
    Swal.fire({
        title: '<strong>CONSULTANDO</strong>',
        html: "Se esta realizando consulta.</br> <strong>Por favor espere...</strong>",
        icon: 'warning',
        timer: 3000,
        timerProgressBar: true,
        showConfirmButton: false,
        padding: '35px',

    });
}
</script>

<style>
button[disabled=disabled],
button:disabled,
button.bg-success:hover {}

.bg-success {

    border-radius: 6px;
}

.bg-success:hover {}

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