@include('common.modalHead')

<div class="row">
	
<div class="col-sm-12 col-md-8">
	<div class="form-group">
		<label ><strong>Nombre Completo</strong></label>
		<input type="text" wire:model.lazy="name" 
		class="form-control" placeholder="ej: Bryan Ariza"  >
		@error('name') <span class="text-danger er">{{ $message}}</span>@enderror
	</div>
</div>
<div class="col-sm-12 col-md-4">
	<div class="form-group">
		<label ><strong>Teléfono</strong></label>
		<input type="text" wire:model.lazy="phone" 
		class="form-control" placeholder="ej: 351 115 9550" maxlength="10" >
		@error('phone') <span class="text-danger er">{{ $message}}</span>@enderror
	</div>
</div>
<div class="col-sm-12 col-md-6">
	<div class="form-group">
		<label ><strong>Correo Electrónico</strong></label>
		<input type="text" wire:model.lazy="email" 
		class="form-control" placeholder="ej: prueba@gmail.com"  >
		@error('email') <span class="text-danger er">{{ $message}}</span>@enderror
	</div>
</div>
<div class="col-sm-12 col-md-6">
	<div class="form-group">
		<label ><strong>Contraseña</strong></label>
		<input type="password" wire:model.lazy="password" 
		class="form-control"   >
		@error('password') <span class="text-danger er">{{ $message}}</span>@enderror
	</div>
</div>
<div class="col-sm-12 col-md-6">
	<div class="form-group">
		<label><strong>Estatus</strong></label>
		<select wire:model.lazy="status" class="form-control">
			<option value="Elegir" selected>Elegir</option>
			<option value="Active" selected>Activo</option>
			<option value="Locked" selected>Bloqueado</option>
		</select>
		@error('status') <span class="text-danger er">{{ $message}}</span>@enderror
	</div>
</div>
<div class="col-sm-12 col-md-6">
	<div class="form-group">
		<label ><strong>Asignar Role</strong></label>
		<select wire:model.lazy="profile" class="form-control">
			<option value="Elegir" selected>Elegir</option>
			@foreach($roles as $role)
			<option value="{{$role->name}}" selected>{{$role->name}}</option>
			@endforeach
		</select>
		@error('profile') <span class="text-danger er">{{ $message}}</span>@enderror
	</div>
</div>

<div class="col-sm-12 col-md-6">
	<div class="form-group">
		<label ><strong>Imágen de Perfil</strong></label>
		<input type="file" wire:model="image" accept="image/x-png, image/jpeg, image/gif" class="form-control">
		@error('image') <span class="text-danger er">{{ $message}}</span>@enderror

	</div>
</div>
</div>


@include('common.modalFooter')