<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Comprobante de Pago</title>

    <!-- ruta física relativa OS -->
    <link rel="stylesheet" href="{{ public_path('css/custom_pdf.css') }}">
    <link rel="stylesheet" href="{{ public_path('css/custom_page.css') }}">

</head>

<body>

    <section class="header" style="top: -287px;">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td colspan="2" class="text-right">
                    <span style="font-size: 12px"><strong>Fecha de Compra:
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
                    <span style="font-size: 25px; font-weight: bold;">COMPROBANTE DE PAGO</span>


                </td>
            </tr>
        </table>
    </section>

    <!-- Agregar la marca de agua -->
    <img src="{{ public_path('assets/img/logo-fast.png') }}" alt="" class="watermark">

    @foreach($dataHeader as $dataHea)
    <section style="margin-top: -110px">
        <section style="margin-top: -110px">
            <section style="margin-top: -50px">
                <h4>

                    CLIENTE:&nbsp;{{$dataHea->name_customer .' '.$dataHea->last_customer}}<br>
                    IDENTIFICACIÓN:&nbsp;{{$dataHea->name_document .' - '.$dataHea->docu}}<br>
                    VENDEDOR:&nbsp;{{$dataHea->first_name .' '.$dataHea->last_name}}


                </h4>
            </section>
        </section>
        <section style="margin-top: -5x">
            <table cellpadding="0" cellspacing="0" class="table-items" width="100%">
                <thead>
                    <tr>
                        <th width="40%">NOMBRE PRODUCTO</th>
                        <th width="40%">CANTIDAD COMPRADOS</th>
                        <th width="40%">PRECIO UNITARIO</th>
                        <th width="40%">PRECIO MAS CANTIDAD</th>


                    </tr>
                </thead>
                <tbody>

                    @foreach($dataDetail as $dataDet)
                    @if($dataDet->id_sales_header == $dataHea->id)
                    <tr>
                        <td class="text-center">{{$dataDet->product_name}}</td>
                        <td class="text-center">{{$dataDet->cant_product}}</td>
                        <td class="text-center">${{number_format($dataDet->unit_price)}}</td>
                        <td class="text-center">${{number_format($dataDet->unit_price * $dataDet->cant_product)}}</td>

                    </tr>
                    @endif
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <td class="text-center">
                            <span><b>TOTALES</b></span>
                        </td>
                        <td class="text-center">
                            {{$dataDetail->sum('cant_product')}}
                        </td>
                        <td class="text-center">
                        </td>
                        <td class="text-center">
                            ${{number_format($dataHea->total_sale)}}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </section>


        <section class="footer">
            @endforeach

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