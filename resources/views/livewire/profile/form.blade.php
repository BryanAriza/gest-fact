<div>
    <form class="form-horizontal">

        <div class="row">
            <div class="col-sm-12">
                <label for="name">Nombre</label>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="fas fa-user">

                            </span>
                        </span>
                    </div>
                    <input type="text" wire:model.lazy="name" class="form-control"
                        placeholder="ej: Camilo Guzman Sandoval" maxlength="255">
                </div>
                @error('name')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
            </div>

            {{-- <div class="col-sm-12">
                <label for="email">Correo</label>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="fas fa-at">

                            </span>
                        </span>
                    </div>
                    <input type="text" wire:model.lazy="email" class="form-control"
                        placeholder="ej: correo@gmail.com" maxlength="255">
                </div>
                @error('email')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
            </div> --}}

            <div class="col-sm-12">
                <label for="phone">Telefono</label>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="fas fa-phone">

                            </span>
                        </span>
                    </div>
                    <input type="text" wire:model.lazy="phone" class="form-control"
                        placeholder="ej: 3008563247" maxlength="255">
                </div>
                @error('phone')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-sm-12">
                <div class="form-group button ">
                    <button type="button" wire:click.prevent="Store({{ auth()->user()->id }})"
                        class="btn mt-2 btn-block"
                        style="background-color: #3b3f5c !important; color:white !important;"><i
                            class="fas fa-user-edit"></i> Actualizar</button>
                    {{-- <a role="button" href="admin/index.html" class="bizwheel-btn theme-2">Login</a> --}}
                </div>
            </div>
        </div>
    </form>
</div>
