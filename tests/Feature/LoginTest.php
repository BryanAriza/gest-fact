<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

it('Muestra errores de validacion cuando faltan datos.', function () {
    $response = $this->post('/login', [
        'email' => '',
        'password' => '',
        'g-recaptcha-response' => '',
    ]);

    $response->assertSessionHasErrors([
        'email' => 'Usuario o contraseña incorrecta',
        'password' => 'Usuario o contraseña incorrecta',
        'g-recaptcha-response' => 'Debe realizar validacion ReCatpcha',
    ]);
});

it('Muestra errores de Inicio de sesión.', function () {
    $response = $this->post('/login', [
        'email' => 'admin@gmail.com',
        'password' => '22222222',
        'g-recaptcha-response' => 'test',
    ]);
    $response->assertSessionHasErrors([
        'email' => 'Usuario o contraseña incorrecta',
        'password' => 'Usuario o contraseña incorrecta',
        'g-recaptcha-response' => 'Debe realizar validacion ReCatpcha',
    ]);
});