<div class="row">

    <div class="col-sm-12">
        <div>
            <div class="connect-sorting">

                <h5 class="text-center mb-3" style="color:#ffff;">RESUMEN DE VENTA</h5>

                <div class="connect-sorting-content">
                    <div class="card simple-title-task ui-sortable-handle">
                        <div class="card-body">

                            <div class="task-header">
                                @include('common.searchboxcustomer')
                                <div>
                                    <h4 style="font-weight: bold;text-align:center;">{{ __('PROCESO VENTA') }}</h4>
                                    <br>
                                    <h4><strong
                                            style="font-weight: bold;">Total:</strong>&nbsp;${{number_format($total)}}
                                    </h4>
                                    <input type="hidden" id="hiddenTotal" value="{{$total}}">
                                </div>
                                <div>
                                    <h4 class="mt-3"><strong
                                            style="font-weight: bold;">Articulos:</strong>&nbsp;{{$itemsQuantity}}</h4>
                                </div>

                                <div class="input-group input-group-md mb-3 mt-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text input-gp hideonsm"
                                            style="background: #6a5330 !important; color:white">Efectivo
                                        </span>
                                    </div>
                                    <input type="number" id="cash" wire:model="efectivo" wire:keydown.enter="saveSale"
                                        class="form-control text-center" value="{{$efectivo}}">
                                    <div class="input-group-append">
                                        <span wire:click="$set('efectivo', 0)" class="input-group-text"
                                            style="background: #6a5330; color:white">
                                            <i class="fas fa-backspace fa-2x"></i>
                                        </span>
                                    </div>
                                </div>

                                <h4 class="text-muted">Cambio: ${{number_format($change)}}</h4>

                                <div class="row justify-content-between mt-5">
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        @if($total > 0)
                                        <button onclick="confirmDelete()" class="btn btn-danger mtmobile">
                                            CANCELAR
                                        </button>
                                        @endif
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        @if($efectivo>= $total && $total > 0)
                                        <button wire:click.prevent="saveSale"
                                            class="btn btn-success btn-md btn-block">FACTURAR</button>
										@endif
                                    </div>


                                </div>


                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>


    </div>
    <script>
    function confirmDelete() {
        Swal.fire({
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
                window.livewire.emit('clearCart')
                swal.close()
            }

        });
    }

    </script>