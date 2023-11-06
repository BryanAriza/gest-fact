<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>Reporte de Ventas</title>

	<!-- ruta física relativa OS -->
	<link rel="stylesheet" href="{{ public_path('css/custom_pdf.css') }}">
	<link rel="stylesheet" href="{{ public_path('css/custom_page.css') }}">

</head>
<body>
	
	<section class="header" style="top: -287px;">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td colspan="2" class="text-center">
					<span style="font-size: 25px; font-weight: bold;">Gest-Fact</span>
				</td>
			</tr>
			<tr>
				<td width="30%" style="vertical-align: top; padding-top: 10px; position: relative">
					<img src="{{ asset('assets/img/logo-fast.png') }}" alt="" class="invoice-logo">
				</td>

				<td width="70%" class="text-left text-company" style="vertical-align: top; padding-top: 10px">
				
					<span style="font-size: 16px"><strong>Listado de Productos</strong></span>
					<br>
					<span style="font-size: 16px"><strong>Fecha de Consulta: {{ \Carbon\Carbon::now()->format('d-M-Y')}}</strong></span>
					<br>
				</td>
			</tr>
		</table>
	</section>


	<section style="margin-top: -110px">
		<table cellpadding="0" cellspacing="0" class="table-items" width="100%">
			<thead>
				<tr>
					<th width="10%">ID PRODUCTO</th>
					<th width="10%">NOMBRE PRODUCTO</th>
					<th width="12%">DESCRIPCIÓN</th>
					<th width="10%">CATEGORIA PRODUCTO</th>
					<th width="12%">PRECIO UNITARIO</th>
					<th width="12%">EXISTENCIAS PRODUCTO</th>
					<th width="18%">IVA PRODUCTO</th>
					<th width="12%">FECHA CREACIÓN</th>

				</tr>
			</thead>
			<tbody>
				@foreach($data as $item)
				<tr>
					<td align="center">{{$item->id}}</td>
					<td align="center">{{$item->product_name}}</td>
					<td align="center">{{$item->description}}</td>
					<td align="center">{{$item->category_name}}</td>
					<td align="center">{{$item->price}}</td>
					<td align="center">{{$item->stock}}</td>
					<td align="center">{{$item->iva}}</td>
					<td align="center">{{$item->created_at}}</td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<td class="text-center">
						<span><b>TOTALES</b></span>
					</td>	
					<td class="text-center">
						{{$data->sum('id')}}
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