@include('common.modalHead')

<div class="row">
	
    <div class="col-sm-8 col-md-6">
        <div class="form-group">
            <label><strong>Nombre de Categoría</strong></label>
            <input type="text" wire:model.lazy="category_name" 
            class="form-control category-name" placeholder="ej: Relojeria Masculina" autofocus >
            @error('category_name') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <label><strong>Descripción de la Categoría</strong></label>
            <textarea wire:model.lazy="description" 
                    class="form-control"
                    placeholder="Escribe la descripción aquí..."></textarea>
            @error('description') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>

</div>




@include('common.modalFooter')

