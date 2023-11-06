<div class="widget widget-chart-one py-2">


    <div class="widget m-3">
        <h4 class="card-title  mb-5 p-3" style="text-align: center;">
            <b>CONSOLIDADO CARGUE POR ESPECIALIDAD</b>

        </h4>

    </div>

    <div class="col-lg-5 col-md-4 col-sm-12 mb-2 text-center ml-auto">
    @if (count($datos) != 0)
        <a class="btn btn-md btn-dark font-weight-bold mt-2"
            href="{{ url('reportConso/excel') }}" target="_blank">
            <i class="fas fa-file-excel mr-2 ml-1 mt-1"></i>
            Exportar Consolidado
        </a>
        <a class="btn btn-md btn-dark font-weight-bold mt-2" href="{{ url('reportDeta/excel') }}" target="_blank">
            <i class="fas fa-file-excel mr-2 ml-1 mt-1"></i>
            Exportar Detallado
        </a>
    @else
        <a class="btn btn-md btn-dark font-weight-bold mt-2" disabled>
            <i class="fas fa-file-excel mr-2 ml-1 mt-1"></i>
            Exportar Consolidado
        </a>
        <a class="btn btn-md btn-dark font-weight-bold mt-2" disabled>
            <i class="fas fa-file-excel mr-2 ml-1 mt-1"></i>
            Exportar Detallado
        </a>
    @endif
    </div>
    </br>


    <div class="col-sm-12">

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped mt-1">
                <thead class="text-white" style="background: #3B3F5C">
                    <tr>
                        <th class="text-white text-center">ESPECIALIDAD</th>
                        <th class="text-white text-center">CANTIDAD DE PACIENTES CARGADOS</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($datos) != 0)
                    @foreach($datos as $datosConsoli)
                    <tr>
                        <td class="text-center">
                            <h6>{{$datosConsoli->especialidad}}</h6>
                        </td>
                        <td class="text-center">
                            <h6>{{$datosConsoli->cantidad}}</h6>
                        </td>
                    </tr>

                    @endforeach
                    @else
                    <tr>
                        <td class="text-center" colspan="8">NO HAY RESULTADOS</td>
                    </tr>

                    @endif
                </tbody>
            </table>
        </div>
        <br>
        @if (count($datos) != 0)
        @if ($datos->hasPages())
        <div style="width: 100%; text-align: center;">
            <div style="display: inline-block;">
                {{$datos->links()}}
            </div>
        </div>
        @endif
        @endif
    </div>


</div>

</div>