@can('Permission_Index')
<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-header" style="color: #ffffff;">
                    <b>{{$componentName}} | {{ $pageTitle }}</b>
                </h4>


                <div class="card-body">
                    <div class="row">

                        @include('common.searchboxrol')

                        <div class="col-sm-14 col-md-6">
                        </div>

                        <div class="col-sm-3 col-md-3 py-4">
                            <div class="text-center">
                                <div class="widget-heading">
                                    <ul class="tabs tab-pills">
                                        <li>
                                            <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal"
                                                data-target="#theModal">Agregar Permiso</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="widget-content">

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped mt-1">
                                <thead class="text-white" style="background: #23741e">
                                    <tr>

                                        <th class="table-th text-white text-center">ID</th>
                                        <th class="table-th text-white text-center">DESCRIPCIÓN</th>
                                        <th class="table-th text-white text-center">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($permisos as $permiso)
                                <tr>
                                    <td class="text-center">
                                        <h6>{{$permiso->id}}</h6>
                                    </td>
                                    <td class="text-center">
                                        <h6>{{$permiso->name}}</h6>
                                    </td>

                                    <td class="text-center">
                                        <a href="javascript:void(0)" wire:click="Edit({{$permiso->id}})"
                                            class="btn btn-dark mtmobile" title="Editar Registro">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="javascript:void(0)" onclick="Confirm('{{$permiso->id}}')"
                                            class="btn btn-danger" title="Eliminar Registro">
                                            <i class="fas fa-trash"></i>
                                        </a>


                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$permisos->links()}}
                        </div>

                    </div>
                </div>



            </div>


        </div>

        @include('livewire.permisos.form')
    </div>

    @endcan

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
    document.addEventListener('DOMContentLoaded', function() {



        window.livewire.on('permiso-added', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('permiso-updated', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('permiso-deleted', Msg => {
            noty(Msg)
        })
        window.livewire.on('permiso-exists', Msg => {
            noty(Msg)
        })
        window.livewire.on('permiso-error', Msg => {
            noty(Msg)
        })
        window.livewire.on('hide-modal', Msg => {
            $('#theModal').modal('hide')
        })
        window.livewire.on('show-modal', Msg => {
            $('#theModal').modal('show')
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
            confirmButtonText: 'Aceptar',
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('destroy', id)
                swal.close()
            }

        })
    }
    </script>