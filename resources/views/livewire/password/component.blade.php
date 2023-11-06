@section('title')
CAMBIAR CONTRASEÑA | AGENDAMIENTO CITAS
@endsection
<div class="row layout-top-spacing d-flex justify-content-center">


    <div class="col-sm-12 col-md-8">
        <div class="connect-sorting">
        <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>

            <h2 class="text-center mb-3">Editar Contraseña de usuario</h2>

            <div class="connect-sorting-content">
                <div class="card simple-title-task ui-sortable-handle">
                    <div class="card-body">
                        @include('livewire.password.form')
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
    <script type="application/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            window.livewire.on('password-updated', msg => {
                noty(msg)
            });
        });
    </script>
