<div class="col-lg-12 col-md-6 col-sm-6" style="align_items:center;">
    <h4 style="font-weight: bold;text-align:center;">{{ __('DATOS CLIENTE') }}</h4>
    <br>
    <h6 style="font-weight: bold;">{{ __('Busqueda por documento') }}</h6>
    <div class="input-group mb-4">
        <div class="input-group-prepend">
            <button wire:click="updateCustomer" class="input-group-text input-gp">
                <i class="fas fa-search"></i>
            </button>
        </div>
        <input type="text" wire:model="documentNum" placeholder="Buscar" class="form-control">
    </div>
    @error('documentNum') <span class="text-danger er">{{ $message}}</span>@enderror
    @error('first_name') <span class="text-danger er">{{ $message}}</span>@enderror
</div>
@if($first_name)
<div class="col-lg-12 col-md-6 col-sm-6" style="align_items:center;">
    <div class="form-group">
        <label><strong>N° Documento</strong></label>
        <br>
        <label wire:model="document">{{$document}}</label>
    </div>
    <div class="form-group">
        <label><strong>Nombre Completo</strong></label>
        <br>
        <label wire:model="first_name">{{$first_name.' '.$last_name}}</label>
    </div>
    <div class="form-group">
        <label><strong>Teléfono</strong></label>
        <br>
        <label wire:model="phone">{{$phone}}</label>
    </div>
    <div class="form-group">
        <label><strong>Correo Electronico</strong></label>
        <br>
        <label wire:model="email">{{$email}}</label>
    </div>
</div>
@endif
<hr>
<style>
.input-gp {
    background: #f2a612 !important;
    color: white !important;
}
</style>