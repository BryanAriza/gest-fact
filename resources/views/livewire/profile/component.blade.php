
@section('title')
PERFIL | AGENDAMIENTO CITAS
@endsection
<div class="row layout-top-spacing">
    <div class="col-sm-12 col-md-4">
        <div class="connect-sorting">
            <div class="connect-sorting-content">
                <div class="card card-info card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            @if (auth()->user()->image != 'avatar.jpg')
                                <img src="{{ asset('storage/users/' . auth()->user()->image) }}" alt="Avatar"
                                    class="profile-user-img img-fluid rounded-circle img-fluid mr-2"
                                    style="width: 200px;">
                            @else
                                <img src="{{ asset('storage/avatar.jpg') }}"
                                    class="profile-user-img img-fluid rounded-circle img-fluid mr-2" alt="Avatar"
                                    style="width: 200px;">
                            @endif

                        </div>
                        <h3 class="profile-username text-center" style="text-transform: uppercase">
                            {{ auth()->user()->name }} </h3>
                        {{-- <p class="text-muted text-center">{{ auth()->user()->role }}</p> --}}
                        <p class="text-muted text-center">{{ auth()->user()->email }}</p>
                        <p class="text-muted text-center">{{ auth()->user()->phone }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-8">
        <div class="connect-sorting">
        <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>

            <h2 class="text-center mb-3">Editar Pefil de usuario</h2>

            <div class="connect-sorting-content">
                <div class="card simple-title-task ui-sortable-handle">
                    <div class="card-body">
                        @include('livewire.profile.form')
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

    <script type="application/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            window.livewire.on('profile-updated', msg => {
                noty(msg)
            });
        });
    </script>
