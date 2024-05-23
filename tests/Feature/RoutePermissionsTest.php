<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Asegúrate de importar el modelo User

class RoutePermissionsTest extends TestCase
{
    use RefreshDatabase;


    public function testGuestCannotAccessProtectedRoutes()
    {
        $guestRedirects = [
            '/users' => '/login',
            '/roles' => '/login',
            '/permisos' => '/login',
            '/asignar' => '/login',
            // Rest of the URLs with their expected redirects for guests
        ];

        foreach ($guestRedirects as $url => $expectedRedirect) {
            $response = $this->get($url);
            $response->assertRedirect($expectedRedirect);
        }
    }

}
