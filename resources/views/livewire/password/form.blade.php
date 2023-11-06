<div>
    <form class="form-horizontal">

        <div class="row">
            <div class="col-sm-12">
                <label for="newpass">Ingresa la nueva contraseña</label>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="fas fa-lock">

                            </span>
                        </span>
                    </div>
                    <input type="password" wire:model.lazy="newpass" class="form-control"
                        placeholder="Digita la contraseña" maxlength="255">
                </div>
                @error('newpass')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-sm-12">
                <label for="newpass_confirmation">Confirma la nueva contraseña</label>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="fas fa-lock">

                            </span>
                        </span>
                    </div>
                    <input type="password" wire:model.lazy="newpass_confirmation" class="form-control"
                        placeholder="Confirma la contraseña" maxlength="255">
                </div>
                @error('newpass_confirmation')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
            </div>



            <div class="col-sm-12">
                <div class="form-group button ">
                    <button type="button" wire:click.prevent="Store({{ auth()->user()->id }})"
                        class="btn mt-2 btn-block"
                        style="background-color: #3b3f5c !important; color:white !important;"><i
                            class="fas fa-user-edit"></i> Cambiar Contraseña</button>
                    {{-- <a role="button" href="admin/index.html" class="bizwheel-btn theme-2">Login</a> --}}
                </div>
            </div>
        </div>
    </form>
</div>
