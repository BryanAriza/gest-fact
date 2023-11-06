@extends('layouts.theme.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Productos
                    <a href="{{route('importar.create')}}" class="btn btn-danger float-right">Importar Archivo</a>
                </div>

                <div class="card-body">
                    
                    <table class="table table-bordered table-striped dato_vacunas" style="width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">Tipo Documento</th>
                                <th scope="col">Identificación</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Fecha de Nacimiento</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('.dato_vacunas').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('importar.index')}}",
            responsive: true,
            columns: [{
                    data: 'name',
                    name: 'importar.name'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'price',
                    name: 'price',
                    searchable: false
                },
                {
                    data: 'quantity_left',
                    name: 'quantity_left',
                    searchable: false
                },
                {
                    data: 'category.name',
                    name: 'category.name'
                }
            ]
        })
    })
</script>
@endsection