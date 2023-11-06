@extends('layouts.theme.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="widget widget-chart-one">
                <div class="card-header" style="color:#ffffff;"><b>ESE Centro | Agendamiento Masivo</b></div>

                <div class="card-body">

                    <strong>
                        <strong>
                            <h5 style="text-align:center">IMPORTANTE</h5>
                        </strong>
                        <p>- RECORDAR QUE LOS ARCHIVOS QUE SE PUEDEN REALIZAR IMPORTACION PARA CARGA DE PACIENTES DEBEN
                            DE
                            ESTAR EN UN FORMATO VALIDO (XLS, XLSX)</p>
                        </br>

                        <p>

                            - EL ORDEN DE LOS ENCABEZADOS EN EL ARCHIVO DEBEN DE IR DE LA SIGUIENTE MANERA, ESTO CON EL
                            FIN
                            DE UNA MEJOR FUNCIONALIDAD AL ALMACENAR LOS DATOS:

                        <ul>
                            <br>
                            <li>
                                <p>tipo_documento (RC, CC, TI, CD, CE, PA, PE, DE, SV, AS, PT)</p>
                            </li>
                            <li>
                                <p>nro_documento</p>
                            </li>
                            <li>
                                <p>nombre_completo</p>
                            </li>
                            <li>
                                <p>organizacion</p>
                            </li>
                            <li>
                                <p>fecha_autorizacion (Formato de fecha: 2023-08-01)</p>
                            </li>
                            <li>
                                <p>id_especialidad (Ej: 010)</p>
                            </li>
                            <li>
                                <p>cups (Ej: 890202)</p>
                            </li>
                            <li>
                                <p>concepto</p>
                            </li>
                            <!--<li>
                                <p>fecha_nacimiento (Formato de fecha: 2023-08-01)</p>
                            </li>-->


                        </ul>
                        </p>
                    </strong>
                    <form action="{{route('importar.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="file" name="import_file"
                            accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                        @error('import_file')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                        <div>
                            <button class="btn btn-primary" type="submit">Importar</button>
                        </div>

                        @if($loading)
                        <div class="loading-spinner">
                            <!-- Coloca aquí tu spinner o cualquier otra indicación de carga -->
                            <i class="fas fa-spinner fa-spin"></i> Cargando...
                        </div>
                        @endif
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
                        <div class="alert alert-danger" role="alert"><svg xmlns="http://www.w3.org/2000/svg"
                                height="1em" viewBox="0 0 512 512">
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

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
<style>
input[type="file"] {
    padding: 10px;
    /* Ajusta este valor según tu preferencia para aumentar el tamaño del botón */
    font-size: 16px;
    /* Ajusta este valor según tu preferencia para aumentar el tamaño del texto del botón */
}

.alert {
    position: relative;
    padding: .75rem 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: .25rem;
}

.col,
.col-1,
.col-10,
.col-11,
.col-12,
.col-2,
.col-3,
.col-4,
.col-5,
.col-6,
.col-7,
.col-8,
.col-9,
.col-auto,
.col-lg,
.col-lg-1,
.col-lg-10,
.col-lg-11,
.col-lg-12,
.col-lg-2,
.col-lg-3,
.col-lg-4,
.col-lg-5,
.col-lg-6,
.col-lg-7,
.col-lg-8,
.col-lg-9,
.col-lg-auto,
.col-md,
.col-md-1,
.col-md-10,
.col-md-11,
.col-md-12,
.col-md-2,
.col-md-3,
.col-md-4,
.col-md-5,
.col-md-6,
.col-md-7,
.col-md-8,
.col-md-9,
.col-md-auto,
.col-sm,
.col-sm-1,
.col-sm-10,
.col-sm-11,
.col-sm-12,
.col-sm-2,
.col-sm-3,
.col-sm-4,
.col-sm-5,
.col-sm-6,
.col-sm-7,
.col-sm-8,
.col-sm-9,
.col-sm-auto,
.col-xl,
.col-xl-1,
.col-xl-10,
.col-xl-11,
.col-xl-12,
.col-xl-2,
.col-xl-3,
.col-xl-4,
.col-xl-5,
.col-xl-6,
.col-xl-7,
.col-xl-8,
.col-xl-9,
.col-xl-auto {
    position: relative;
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
    margin-top: 50px;
}

.card-header {
    padding: .75rem 1.25rem;
    margin-bottom: 0;
    background-color: #23741e;
    border-bottom: 1pxsolidrgba(0, 0, 0, .125);
}

button,
input {
    overflow: visible;
    border: black;
    margin-top: 10px;
}
</style>
<script>

</script>
@endsection