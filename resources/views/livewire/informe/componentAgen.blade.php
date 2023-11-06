<div class="widget widget-chart-one py-2">


    <div class="widget m-3">
        <h4 class="card-title mb-5 p-3" style="text-align: center;">
            <b>CONSOLIDADO CITAS ASIGNADAS Y SIN ASIGNAR</b>

        </h4>

    </div>

    <div class="widget-heading mb-3">
        <div class="row m-3">

            <div class="col-lg-3 col-md-3 col-sm-3">
                <h6 style="font-weight: bold;">{{ __('IPS') }}</h6>
                <select wire:model="selectIps" class="form-control">
                    <option value="0" selected>== Selecciona una IPS ==</option>
                    @foreach ($ips as $ip)
                    <option value="{{ $ip->id_ips }}">{{ $ip->name_ips }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
                <h6 style="font-weight: bold;">{{ __('Especialidad') }}</h6>
                <select wire:model="selectSpe" class="form-control">
                    <option value="0" selected>== Selecciona una especialidad ==</option>
                    @foreach ($speciality as $spe)
                    <option value="{{ $spe->speciality }}">{{ $spe->speciality_name }}</option>
                    @endforeach
                </select>
            </div>

            
            <div class="col-lg-5 col-md-4 col-sm-12 my-3 text-center ml-auto">

            @if (count($datos) != 0)
                <a class="btn btn-md btn-dark font-weight-bold mt-2" href="{{ url('reportCitas/excel' .  '/' . $selectIps . '/' . $selectSpe) }}" target="_blank">
                    <i class="fas fa-file-excel mr-2 ml-1 mt-1"></i>
                    Exportar Consolidado
                </a>
                <a class="btn btn-md btn-dark font-weight-bold mt-2" href="{{ url('reportDetaCi/excel' .  '/' . $selectIps . '/' . $selectSpe) }}" target="_blank">
                    <i class="fas fa-file-excel mr-2 ml-1 mt-1"></i>
                    Exportar Detallado
                </a>
            @else
                <a class="btn btn-md btn-dark font-weight-bold mt-2" disabled>
                    <i class="fas fa-file-excel mr-2 ml-1 mt-1" ></i>
                    Exportar Consolidado
                </a>
                <a class="btn btn-md btn-dark font-weight-bold mt-2" disabled>
                    <i class="fas fa-file-excel mr-2 ml-1 mt-1"></i>
                    Exportar Detallado
                </a>
            @endif

            </div>

        </div>



        </br>


        <div class="col-sm-12">

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped mt-1">

                    @if($selectIps)
                        <thead class="text-white" style="background: #3B3F5C">
                                <tr>
                                    <th class="text-white text-center">IPS</th>
                                    <th class="text-white text-center">ESPECIALIDAD</th>
                                    <th class="text-white text-center">CANTIDAD AGENDADOS</th>
                                    <th class="text-white text-center">CANTIDAD DISPONIBLES</th>
                                </tr>
                        </thead>
                        <tbody>
                            @if (count($datos) != 0)
                            @foreach($datos as $datosCon)
                            <tr>
                                <td class="text-center">
                                    <h6>{{$datosCon->name_ips}}</h6>
                                </td>
                                <td class="text-center">
                                    <h6>{{$datosCon->speciality_name}}</h6>
                                </td>
                                <td class="text-center">
                                    <h6>{{$datosCon->Agendado}}</h6>
                                </td>
                                <td class="text-center">
                                    <h6>{{$datosCon->Disponible}}</h6>
                                </td>
                            </tr>

                            @endforeach
                            @else
                            <tr>
                                <td class="text-center" colspan="8">NO HAY RESULTADOS</td>
                            </tr>

                            @endif
                        </tbody>
                    @else
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <!--<th class="text-white text-center">IPS</th>-->
                                <th class="text-white text-center">ESPECIALIDAD</th>
                                <th class="text-white text-center">CANTIDAD AGENDADOS</th>
                                <th class="text-white text-center">CANTIDAD DISPONIBLES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($datos) != 0)
                            @foreach($datos as $datosCon)
                            <tr>
                                <td class="text-center">
                                    <h6>{{$datosCon->speciality_name}}</h6>
                                </td>
                                <td class="text-center">
                                    <h6>{{$datosCon->Agendado}}</h6>
                                </td>
                                <td class="text-center">
                                    <h6>{{$datosCon->Disponible}}</h6>
                                </td>
                            </tr>

                            @endforeach
                            @else
                            <tr>
                                <td class="text-center" colspan="8">NO HAY RESULTADOS</td>
                            </tr>

                            @endif
                        </tbody>
                        @endif
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