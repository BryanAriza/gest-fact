<?php

use App\Http\Livewire\ProductsController;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProductsControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_cannot_create_a_product_with_non_existing_category()
    {
        try {
            Livewire::test(ProductsController::class)
                ->set('product_name', 'Test Product')
                ->set('description', 'Test Description')
                ->set('category_name', 999) // Assuming 999 is a non-existing category ID
                ->set('price', 10.50)
                ->set('stock', 100)
                ->set('iva', 0.19)
                ->call('Store');
        } catch (\Illuminate\Database\QueryException $e) {
            $this->assertStringContainsString('FOREIGN KEY constraint failed', $e->getMessage());
        }

        $this->assertDatabaseMissing('products', [
            'product_name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 10.50,
            'stock' => 100,
            'iva' => 0.19,
        ]);
    }

    /** @test */
    public function it_can_delete_a_product()
    {
        $product = Product::factory()->create();

        Livewire::test(ProductsController::class)
            ->set('selected_id', $product->id)
            ->call('Destroy', $product);

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }
}
