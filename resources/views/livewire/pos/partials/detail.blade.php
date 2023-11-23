<div class="connect-sorting">
	
<div class="connect-sorting-content">
	<div class="card simple-title-task ui-sortable-handle">
		<div class="card-body">
			
		@if($total > 0)
		<div class="table-responsive tblscroll" style="max-height: 650px; overflow: hidden">
			<table class="table table-bordered table-striped mt-1">
				<thead class="text-white" style="background: #6a5330">
					<tr>
						<th width="10%"></th>
						<th class="table-th text-left text-white">PRODUCTO</th>
						<th class="table-th text-center text-white">PRECIO UNITARIO</th>
						<th width="13%" class="table-th text-center text-white">CANTIDAD</th>
						<th class="table-th text-center text-white">TOTAL PARCIAL</th>
						<th class="table-th text-center text-white">ACCIONES</th>
					</tr>
				</thead>
				<tbody>
					@foreach($cart as $item)
					<tr>
						<td class="text-center table-th">
							@if(count($item->attributes) > 0)
							<span>
								<img src="{{ asset('storage/products/' . $item->attributes[0]) }}" alt="imágen de producto" height="90" width="90" class="rounded">
							</span>
							@endif
						</td>
						<td><h6>{{$item->name}}</h6></td>
						<td class="text-center"><h6>${{number_format($item->price)}}</h6></td>
						<td>
							<input type="number" id="r{{$item->id}}"
							wire:change="updateQty({{$item->id}}, $('#r' + {{$item->id}}).val() )"
							style="font-size: 1rem!important"
							class="form-control text-center" 
							value="{{$item->quantity}}"
							>
						</td>
						<td class="text-center">
							<h6>
								${{number_format($item->price * $item->quantity,2)}}
							</h6>
						</td>
						<td class="text-center">
							<button onclick="ConfirmDe('{{$item->id}}')" class="btn btn-danger mbmobile">
								<i class="fas fa-trash-alt"></i>
							</button>
							<button wire:click.prevent="decreaseQty({{$item->id}})" class="btn btn-edit mbmobile">
								<i class="fas fa-minus"></i>
							</button>
							<button wire:click.prevent="increaseQty({{$item->id}})" class="btn btn-success mbmobile">
								<i class="fas fa-plus"></i>
							</button>

						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		@else
		<h5 class="text-center text-muted">Agrega productos a la venta</h5>
		@endif

<!--
		<div wire:loading.inline wire:target="saveSale">
			<h4 class="text-danger text-center">Guardando Venta...</h4>
		</div>
	-->



		</div>
	</div>
</div>


</div>	
<script>
    function ConfirmDe(id) {
        swal({
            title: 'CONFIRMAR',
            text: '¿CONFIRMAS ELIMINAR EL REGISTRO?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#e7515a',
            confirmButtonColor: '#23741e',
            confirmButtonText: 'Aceptar'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('removeItem', id)
                swal.close()
            }

        });
    }
</script>
