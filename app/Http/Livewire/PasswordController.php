<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class PasswordController extends Component
{
    public $newpass, $newpass_confirmation;
    public function render()
    {
        return view('livewire.password.component')->extends('layouts.theme.app')->section('content');
    }
    public function Store(User $user)
    {
        $rules =[
            'newpass' => 'required|min:6|max:30|confirmed',
        ];
        $messages = [
            'newpass.required' => 'La contraseña es requerida',
			'newpass.min' => 'La contraseña del usuario debe tener al menos 6 caracteres',
			'newpass.max' => 'La contraseña del usuario debe tener maximo 30 caracteres',
			'newpass.confirmed' => 'Asegurate que ambas contraseñas coincidan',

        ];
		$this->validate($rules, $messages);
        $user->update([
            'password' => bcrypt($this->newpass)
        ]);
        $user->save();
        $this->emit('password-updated', 'Contraseña Actualizada');
        $this->resetValidation();
    }
}
