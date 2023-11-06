<?php

namespace App\Http\Livewire;
use App\Models\User;
use Livewire\Component;

class ProfileController extends Component
{
    public $name, $email, $phone, $newpass, $newpass_confirmation;
    public function mount()
    {
        $this->name= auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->phone = auth()->user()->phone;
    }

    public function render()
    {
        return view('livewire.profile.component')->extends('layouts.theme.app')
        ->section('content');
    }

    public function Store(User $user)
    {

        $rules =[
            'name' => 'required|string|min:5|max:40|regex:/^[ña-zA-Z ]+$/',
            'phone' => 'required|numeric|digits:10',
            // 'email' => 'required|email|unique:users,email,'.$user->id
        ];
        $messages = [
            'name.required' => 'El nombre es requerido',
			'name.string' => 'El nombre debe contener caracteres',
			'name.min' => 'El nombre del usuario debe tener al menos 3 caracteres',
			'name.max' => 'El nombre del usuario debe tener maximo 40 caracteres',
			'name.regex' => 'Asegurate que el formato sea alfanumerico',
            'phone.required' => 'El numero de telefono es requerido',
			'phone.numeric' => 'El formato debe ser numerico',
			'phone.digits' => 'El numero de telefono debe contener 10 digitos',
            // 'email.required' => 'El correo electronico es requerido',
			// 'email.email' => 'El formato del correo es incorrecto',
			// 'email.unique' => 'Ya existe un correo electronico con este email',
        ];
		$this->validate($rules, $messages);
        $user->update([
            'name' => $this->name,
            'phone' => $this->phone,
            // 'email' => $this->email,
        ]);

        $user->save();
        $this->emit('profile-updated', 'Usuario Actualizado');
        $this->resetValidation();
    }

    public function StorePassword(User $user)
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
