<div class="col-lg-3 col-md-3 col-sm-3" style="align_items:center;">
<h6 style="font-weight: bold;">{{ __('Busqueda por documento') }}</h6>
    <div class="input-group mb-4">
        <div class="input-group-prepend">
            <span class="input-group-text input-gp">
                <i class="fas fa-search"></i>
            </span>
        </div>
        <input type="text" wire:model="search" placeholder="Buscar" class="form-control">
    </div>

</div>

<style>
.input-gp {
    background: #f2a612 !important;
    color: white !important;
}
</style>