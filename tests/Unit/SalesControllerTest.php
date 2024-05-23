<?php

use App\Http\Livewire\SalesController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use App\Models\Product;
use Tests\TestCase;

class SalesControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_cannot_scan_a_non_existing_product()
    {
        $nonExistingProductId = 999;

        Livewire::test(SalesController::class)
            ->call('ScanCode', $nonExistingProductId)
            ->assertEmitted('global-error-msg', 'Producto no encontrado');
    }
}
