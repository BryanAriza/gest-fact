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

                        
                        @include('common.searchboxuser')

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <h6 style="font-weight: bold;">{{ __('Fecha Desde') }}</h6>
                            <input type="date" wire:model="startDate" class="form-control">
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <h6 style="font-weight: bold;">{{ __('Fecha Hasta') }}</h6>
                            <input type="date" wire:model="endDate" class="form-control">
                        </div>
                        
                        <div class="col-sm-14 col-md-3 py-4">
                        @if (count($datos) != 0)
                            <a class="btn btn-md btn-success font-weight-bold mt-2 text-center"
                                href="{{ url('reportSales/excel/' . ($search ?? '0') . '/' . ($startDate ?? 0 ) . '/' . ($endDate ?? 0) ) }}" target="_blank" title="Exportar XLS de productos"> 
                                <i class="fas fa-file-excel mr-2 ml-1 mt-1"></i>
                                Excel
                            </a>
                            <a class="btn btn-md btn-danger font-weight-bold mt-2" href="{{ url('reportSales/excel' . '/' . $search .  '/' . $startDate .  '/' . $endDate) }}" target="_blank" title="Exportar PDF de productos"> 
                                <i class="fas fa-file-pdf mr-2 ml-1 mt-1"></i>
                                PDF 
                            </a>
                        @else
                            <a class="btn btn-md btn-success font-weight-bold mt-2" disabled>
                                <i class="fas fa-file-excel mr-2 ml-1 mt-1"></i>
                                Excel
                            </a>
                            <a class="btn btn-md btn-danger font-weight-bold mt-2" disabled>
                                <i class="fas fa-file-pdf mr-2 ml-1 mt-1"></i>
                                PDF
                            </a>
                        @endif
                        </div>
                        
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped mt-1">
                            <thead class="text-white" style="background: #3B3F5C">
                                <tr>
                                    <th class="table-th text-white text-center">NOMBRE CLIENTE</th>
                                    <th class="table-th text-white text-center">TIPO DOCUMENTO</th>
                                    <th class="table-th text-white text-center">DOCUMENTO</th>
                                    <th class="table-th text-white text-center">NOMBRE VENDEDOR</th>
                                    <th class="table-th text-white text-center">ROL VENDEDOR</th>
                                    <th class="table-th text-white text-center">VALOR VENTA FINAL</th>
                                    <th class="table-th text-white text-center">FECHA REALIZA VENTA</th>
                                    <th class="table-th text-white text-center">DETALLE VENTA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($datos) <= 0) <tr>
                                    <td class="text-center" colspan="8">NO HAY RESULTADOS</td>
                                    </tr>
                                    @else
                                    @foreach($datos as $datosCat)
                                        <tr>
                                            <td class="text-center">
                                                <h6>{{$datosCat->customer_name}}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>{{$datosCat->name_document}}</h6>
                                            </td>
                                            <td class="text-center">
                                                <h6>{{$datosCat->document}}</h6>
                                            </td>
                                            
                                            <td class="text-center">
                                                <h6>{{$datosCat->user}}</h6>
                                            </td>

                                            <td class="text-center">
                                                <h6>{{$datosCat->rol}}</h6>
                                            </td>
                                            
                                            <td class="text-center">
                                                <h6>${{ str_replace(',', '.', number_format($datosCat->total_sale)) }}</h6>
                                            </td>
                                            
                                            <td class="text-center">
                                                <h6>{{$datosCat->date_sale}}</h6>
                                            </td>

                                            <td class="text-center">
                                                <a href="javascript:void(0)" wire:click="showSaleDetails({{$datosCat->id}})"
                                                    class="btn btn-success" title="Editar Producto">
                                                    <i class="fas fa-folder-open"></i>
                                                </a>
                                            </td>
                                            
                                        </tr>
                                        
                                    @endforeach
                                    @if(count($datos) > 0)
                                            <tr>
                                                <td class="text-center" colspan="5"><strong>TOTAL VENDIDO</strong></td>
                                                <td class="text-center">
                                                    <h6>${{ str_replace(',', '.', number_format($totalVentas)) }}</h6>
                                                </td>
                                                <td class="text-center"></td>
                                            </tr>
                                        @endif
                                    @endif

                                    </tr>
                            </tbody>
                        </table>

                    </div>
                    {{$datos->links()}} 
                </div>


            </div>


        </div>
        @include('livewire.reports.form')
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
</script>


