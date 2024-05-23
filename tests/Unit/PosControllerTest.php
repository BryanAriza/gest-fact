<?php

use App\Http\Livewire\PosController;
use App\Models\Customer;
use App\Models\Product;
use App\Models\SalesHeader;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PosControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_complete_a_sale()
    {
        // Crear un usuario autenticado
        $user = User::factory()->create();
        $this->actingAs($user);

        // Crear un cliente
        $customer = Customer::factory()->create([
            'document' => '123456789',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'phone' => '1234567890',
        ]);

        // Crear un producto
        $product = Product::factory()->create([
            'name' => 'Product 1',
            'price' => 100,
            'stock' => 10,
        ]);

        // Añadir el producto al carrito (puedes necesitar simular esto si usas un paquete de carrito)
        Cart::add($product->id, $product->name, $product->price, 2);

        // Probar el método saveSale
        Livewire::test(PosController::class)
            ->set('documentNum', $customer->document)
            ->set('efectivo', 250)
            ->call('updateCustomer')
            ->call('saveSale')
            ->assertEmitted('sale-ok', 'Venta registrada con éxito');

        // Verificar que la venta se ha guardado en la base de datos
        $this->assertDatabaseHas('sales_headers', [
            'id_customer' => $customer->id,
            'total_sale' => 200, // 100 * 2 (cantidad)
        ]);

        $this->assertDatabaseHas('sales_details', [
            'id_product' => $product->id,
            'cant_product' => 2,
            'unit_price' => $product->price,
        ]);

        // Verificar que el stock del producto se ha actualizado
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'stock' => 8, // 10 - 2 (cantidad vendida)
        ]);
    }
}
