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

                        @can('Customer_Search')
                                @include('common.searchboxuser')
                        @endcan
                        <div class="col-sm-14 col-md-3 py-4">
                        @if (count($datos) != 0)
                            <a class="btn btn-md btn-success font-weight-bold mt-2 text-center"
                                href="{{ url('reportCliente/excel' . '/' . $search) }}" target="_blank" title="Exportar XLS de clientes">
                                <i class="fas fa-file-excel mr-2 ml-1 mt-1"></i>
                                Reporte Excel
                            </a>
                            
                        @else
                            <a class="btn btn-md btn-success font-weight-bold mt-2" disabled>
                                <i class="fas fa-file-excel mr-2 ml-1 mt-1"></i>
                                Reporte Excel
                            </a>
                            
                        @endif
                        </div>
                        <div class="col-sm-3 col-md-3 py-4">
                            
                        </div>

                        @can('Customer_Create')
                        <div class="col-sm-3 col-md-3 py-4">
                            <div class="text-center">
                                <div class="widget-heading">
                                    <ul class="tabs tab-pills">
                                        <li>
                                            <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal"
                                                data-target="#theModal">AGREGAR CLIENTE</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endcan
                        
                    </div>


                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped mt-1">
                            <thead class="text-white" style="background: #3B3F5C">
                                <tr>
                                    <th class="table-th text-white text-center">NOMBRE COMPLETO</th>
                                    <th class="table-th text-white text-center">TIPO DE DOCUMENTO</th>
                                    <th class="table-th text-white text-center">N° DOCUMENTO</th>
                                    <th class="table-th text-white text-center">TELEFONO</th>
                                    <th class="table-th text-white text-center">CORREO ELECTRONICO</th>
                                    <th class="table-th text-white text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($datos) <= 0) <tr>
                                    <td class="text-center" colspan="8">NO HAY RESULTADOS</td>
                                    </tr>
                                    @else
                                    @foreach($datos as $datosCus)
                                        <tr>
                                            <td class="text-center">
                                                <h6>{{$datosCus->first_name." ".$datosCus->last_name}}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>{{$datosCus->name_document}}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>{{$datosCus->document}}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>{{$datosCus->phone}}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>{{$datosCus->email}}</h6>
                                            </td>                                     
                                            <td class="text-center">
                                                @can('Product_Update')
                                                <a href="javascript:void(0)" wire:click="Edit({{$datosCus->id}})"
                                                    class="btn btn-edit" title="Editar Producto">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @endcan
                                                @can('Product_Destroy')
                                                <a href="javascript:void(0)" onclick="Confirm('{{$datosCus->id}}')"
                                                    class="btn btn-danger" title="Eliminar Producto">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                @endcan
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
        @include('livewire.customers.form')
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
        font-size: 15px;
        letter-spacing: 1px;
        font-weight: 600;
        padding: 5px 7px;
        background: #6a5330 !important;
        color: #fff;
        border-radius: 4px;
        margin-left: 20px;
        margin-top: 5px;
        padding:12px;
    }

    .widget-chart-one .widget-heading .tabs a:hover {
        font-size: 15px;
        letter-spacing: 1px;
        font-weight: 600;
        padding: 5px 7px;
        background: #cb8a0d !important;
        color: #fff;
        border-radius: 4px;
        margin-left: 20px;
        padding:11px;
    }

    .widget-chart-one .widget-heading {
        display: block;
        justify-content: space-between;
    }

    .card-header {
        padding: .75rem 1.25rem;
        margin-bottom: 0;
        background-color: #cb8a0d;
        border-bottom: 1px solid rgba(0, 0, 0, .125);
    }

    .table>thead>tr>th {
        background: #cb8a0d !important;
        font-weight: 700;
        font-size: 13px;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: #cb8a0d;
        border-color: #cb8a0d;
    }

    .tbody {
        overflow: auto;
    }

    .table-responsive {

        /*Firefox*/
        overflow: scroll;
        scrollbar-color: #cb8a0d transparent;
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
        background-color: #cb8a0d;
    }
    </style>


    <script>
    
	document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('product-added', msg => {
            $('#theModal').modal('hide')
            swal({
                title: 'Registro Creado!',
                text: msg,
                type: 'success',
                showConfirmButton: false,
                timer: 1600
            })
        });
        window.livewire.on('product-updated', msg => {
            $('#theModal').modal('hide')
            swal({
                title: 'Registro Actualizado!',
                text: msg,
                type: 'success',
                showConfirmButton: false,
                timer: 1600
            })
        });
        window.livewire.on('product-deleted', msg => {
            // noty
            swal({
                title: 'Registro Eliminado!',
                text: msg,
                type: 'success',
                showConfirmButton: false,
                timer: 1600
            })
        });
        window.livewire.on('product-not-deleted', msg => {
            // noty
            swal({
                title: 'Se ha Producido un Error!',
                text: msg,
                type: 'error',
                showConfirmButton: false,
                timer: 1900
            })
        });
        window.livewire.on('modal-show', msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('modal-hide', msg => {
            $('#theModal').modal('hide')
        });
        window.livewire.on('hidden.bs.modal', msg => {
            $('.er').css('display', 'none')			
        });
        $('#theModal').on('hidden.bs.modal', function(e) {
            $('.er').css('display', 'none')
        })
        $('#theModal').on('shown.bs.modal', function(e) {
            $('.product-name').focus()
        })



        });

        function Confirm(id) {

        swal({
            title: 'CONFIRMAR',
            text: '¿CONFIRMAS ELIMINAR EL REGISTRO?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#e7515a',
            confirmButtonColor: '#23741e',
            confirmButtonText: 'Aceptar'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteRow', id)
                swal.close()
            }

        })
        }
    </script>