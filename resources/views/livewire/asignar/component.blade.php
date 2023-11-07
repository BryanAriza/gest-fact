@can('Asignar_Index')
<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-header" style="color: #ffffff;">
                    <b>{{$componentName}} | {{ $pageTitle }}</b>
                </h4>
                <div class="card-body">
                    <div class="widget-content">
                        <div class="row">
                            <div class="col col-sm-12 col-md-4">


                                <div class="form-group mr-5">
                                    <select wire:model="role" class="form-control">
                                        <option value="Elegir" selected>== Selecciona el Role ==</option>
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col col-sm-12 col-md-4">
                                <div class="form-group mr-5">
                                    <select wire:model="user" class="form-control">
                                        <option value="Elegir" selected>== Selecciona un usuario ==</option>
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col col-sm-12 col-md-4">



                                <button wire:click.prevent="syncAll()" type="button"
                                    class="btn btn-dark mbmobile inblock mt-1">Sincronizar Todos</button>
                                <button onclick="Revocar()" type="button" class="btn btn-dark mbmobile  mt-1">Revocar
                                    Todos</button>



                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped mt-1">
                                <thead class="text-white" style="background: #23741e">
                                    <tr>

                                        <th class="table-th text-white text-center">ID</th>
                                        <th class="table-th text-white text-center">PERMISO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permisos as $permiso)
                                    <tr>
                                        <td class="text-center">
                                            <h6>{{ $permiso->id }}</h6>
                                        </td>
                                        <td class="text-center">
                                            <div class="n-check">
                                                <label class="new-control new-checkbox checkbox-primary">
                                                    <input type="checkbox"
                                                        wire:change="syncPermiso($('#p'+{{ $permiso->id }}).is(':checked'), '{{ $permiso->name }}')"
                                                        id="p{{ $permiso->id }}" value="{{ $permiso->id }}"
                                                        class="new-control-input"
                                                        {{ $permiso->checked == 1 ? 'checked' : '' }}>
                                                    <span class="new-control-indicator"></span>
                                                    <h6>{{ $permiso->name }}</h6>
                                                </label>
                                            </div>
                                        </td>
                                        {{-- <td class="text-center"><h6>{{\App\Models\User::permission($permiso->name)->count()}}
                                        </h6>
                                        </td> --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $permisos->links() }}
                        </div>

                    </div>
                </div>

            </div>

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
            background-color: #cb8a0d;
        }
        </style>

        <script type="application/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            window.livewire.on('sync-error', Msg => {
                noty(Msg)
            })
            window.livewire.on('permi', Msg => {
                noty(Msg)
            })
            window.livewire.on('syncall', Msg => {
                noty(Msg)
            })
            window.livewire.on('removeall', Msg => {
                noty(Msg)
            })
        });

        function Revocar() {


            Swal.fire({
                title: 'CONFIRMAR',
                text: '¿CONFIRMAS REVOCAR TODOS LOS PERMISOS?',
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cerrar',
                cancelButtonColor: '#e7515a',
                confirmButtonColor: '#23741e',
                confirmButtonText: 'Aceptar'
            }).then(function(result) {
                if (result.value) {
                    window.livewire.emit('revokeall')
                    swal.close()
                }

            })
        }
        </script>