@include('common.modalHead')

<div class="row">

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label><strong>Nombres</strong></label>
            <input type="text" wire:model.lazy="first_name" class="form-control" placeholder="Ingrese nombre completo">
            @error('first_name') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label><strong>Apellidos</strong></label>
            <input type="text" wire:model.lazy="last_name" class="form-control" placeholder="Ingrese apellidos completos">
            @error('last_name') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>
	
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label><strong>Tipo de Documento</strong></label>
            <select wire:model.lazy="selectTypeDoc" class="form-control">
                <option value="Elegir" selected>-- Seleccione un tipo de documento --</option>
                @foreach($typeDoc as $type)
                <option value="{{$type->id}}" selected>{{$type->name_document}}</option>
                @endforeach
            </select>
            @error('selectTypeDoc') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>
	<div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label><strong>Documento de identidad</strong></label>
            <input type="text" wire:model.lazy="document" class="form-control" placeholder="Ingrese Documento de identidad"
                maxlength="15">
            @error('document') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label><strong>Número de Celular</strong></label>
            <input type="text" wire:model.lazy="phone" class="form-control" placeholder="ej: 351 115 9550"
                maxlength="10">
            @error('phone') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label><strong>Correo Electrónico</strong></label>
            <input type="text" wire:model.lazy="email" class="form-control" placeholder="ej: prueba@gmail.com">
            @error('email') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>

@include('common.modalFooter')