@include('common.modalHead')

<div class="row">
	
    <div class="col-sm-8 col-md-6">
        <div class="form-group">
            <label><strong>Nombre Producto</strong></label>
            <input type="text" wire:model.lazy="product_name" 
            class="form-control product-name" placeholder="ej: Reloj cassio" autofocus >
            @error('product_name') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label><strong>Categoría de Producto</strong></label>
        <select wire:model='category_name' class="form-control">
            <option value="0" selected>== Selecciona una categoria ==</option>
            @foreach($category as $cat)
            <option value="{{$cat->id}}" >{{$cat->category_name}}</option>
            @endforeach
        </select>
        @error('category_name') <span class="text-danger er">{{ $message}}</span>@enderror
    </div>
    </div>

    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <label><strong>Descripción del Producto</strong></label>
            <textarea wire:model.lazy="description" 
                    class="form-control"
                    placeholder="Escribe la descripción aquí..."></textarea>
            @error('description') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>

    

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label><strong>Precio Unitario</strong></label>
            <input type="number" wire:model.lazy="price" class="form-control" placeholder="ej: 100000" >
            @error('price') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label><strong>Existencias del Producto</strong></label>
            <input type="number"  wire:model.lazy="stock" class="form-control" placeholder="ej: 0" >
            @error('stock') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label><strong>Iva</strong></label>
            <input type="number"  wire:model.lazy="iva" class="form-control" placeholder="ej: 10" >
            @error('iva') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>

</div>




@include('common.modalFooter')

