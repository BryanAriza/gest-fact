<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reporte de Categorías</title>

    <!-- ruta física relativa OS -->
    <link rel="stylesheet" href="{{ public_path('css/custom_pdf.css') }}">
    <link rel="stylesheet" href="{{ public_path('css/custom_page.css') }}">

</head>

<body>

    <section class="header" style="top: -287px;">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td colspan="2" class="text-right">
                    <span style="font-size: 12px"><strong>Fecha de Consulta:
                            {{ \Carbon\Carbon::now()->format('d-M-Y')}}</strong></span>
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td width="40%" style="vertical-align: top; padding-top: 10px; position: relative">
                    <img src="{{ public_path('assets/img/login_logo.png') }}" alt="" class="invoice-logo">
                </td>

                <td width="70%" class="text-center text-company" style="vertical-align: top; padding-top: 10px">
                    <br>
                    <span style="font-size: 25px; font-weight: bold;">REGISTRO DE CATEGORIAS</span>

                </td>
            </tr>
        </table>
    </section>

    <!-- Agregar la marca de agua -->
    <img src="{{ public_path('assets/img/logo-fast.png') }}" alt="" class="watermark">

    <section style="margin-top: -110px">
        <section style="margin-top: -110px">
            <table cellpadding="0" cellspacing="0" class="table-items" width="100%">
                <thead>
                    <tr>
                        <th width="30%">ID CATEGORÍA</th>
                        <th width="30%">NOMBRE CATEGORÍA</th>
                        <th width="30%">DESCRIPCIÓN</th>
                        <th width="30%">FECHA CREACIÓN</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td class="text-center">{{$item->id}}</td>
                        <td class="text-center">{{$item->category_name}}</td>
                        <td class="text-center">{{$item->description}}</td>
                        <td class="text-center">{{$item->created_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td class="text-center">
                            <span><b>TOTALES</b></span>
                        </td>
                        <td class="text-center">
                            {{$data->count('id')}}
                        </td>
                        <td colspan="3"></td>
                    </tr>
                </tfoot>
            </table>
        </section>


        <section class="footer">

            <table cellpadding="0" cellspacing="0" class="table-items" width="100%">
                <tr>
                    <td width="20%">
                        <span>Gest-Fact</span>
                    </td>
                    <td width="60%" class="text-center">
                        gest-fact.com
                    </td>
                    <td class="text-center" width="20%">
                        página <span class="pagenum"></span>
                    </td>

                </tr>
            </table>
        </section>

</body>

</html>