<?php

namespace Tests\Unit;

use App\Http\Livewire\Dash;
use App\Models\SalesHeader;
use App\Models\SalesDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DashControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_fails_to_select_top_5_best_products()
    {
        // Simula un año que no existe en la base de datos
        $year = 9999;

        // Crea una instancia de DashController
        $controller = new Dash();

        // Asigna el año simulado a la instancia de DashController
        $controller->year = $year;

        // Intenta obtener los datos de ventas mensuales
        $controller->getTop5();

        // Verifica que la propiedad $top5Data esté vacía
        $this->assertNotEmpty($controller->top5Data);
    }
}
