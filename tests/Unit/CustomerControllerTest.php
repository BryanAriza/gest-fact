<?php

namespace Tests\Feature;

use App\Http\Livewire\CustomerController;
use App\Models\Customer;
use App\Models\TypeDocument;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_customer()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $typeDocument = TypeDocument::factory()->create();

        Livewire::test(CustomerController::class)
            ->set('first_name', 'John')
            ->set('last_name', 'Doe')
            ->set('selectTypeDoc', $typeDocument->id)
            ->set('document', '123456789')
            ->set('phone', '1234567890')
            ->set('email', 'john.doe@example.com')
            ->call('Store')
            ->assertEmitted('product-added', 'Cliente Registrado');

        $this->assertDatabaseHas('customers', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'id_type' => $typeDocument->id,
            'document' => '123456789',
            'phone' => '1234567890',
            'email' => 'john.doe@example.com',
        ]);
    }

    /** @test */
    public function it_can_update_a_customer()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $typeDocument = TypeDocument::factory()->create();

        $customer = Customer::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'id_type' => $typeDocument->id,
            'document' => '123456789',
            'phone' => '1234567890',
            'email' => 'john.doe@example.com',
        ]);

        Livewire::test(CustomerController::class)
            ->call('Edit', $customer)
            ->set('first_name', 'Jane')
            ->set('last_name', 'Doe')
            ->set('selectTypeDoc', $typeDocument->id)
            ->set('document', '987654321')
            ->set('phone', '0987654321')
            ->set('email', 'jane.doe@example.com')
            ->call('Update')
            ->assertEmitted('product-updated', 'Producto Actualizado');

        $this->assertDatabaseHas('customers', [
            'id' => $customer->id,
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'id_type' => $typeDocument->id,
            'document' => '987654321',
            'phone' => '0987654321',
            'email' => 'jane.doe@example.com',
        ]);
    }

    /** @test */
    public function it_can_delete_a_customer_without_pending_sales()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $typeDocument = TypeDocument::factory()->create();

        $customer = Customer::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'id_type' => $typeDocument->id,
            'document' => '123456789',
            'phone' => '1234567890',
            'email' => 'john.doe@example.com',
        ]);

        Livewire::test(CustomerController::class)
            ->call('Destroy', $customer)
            ->assertEmitted('product-deleted', 'Cliente Eliminado');

        $this->assertDatabaseMissing('customers', [
            'id' => $customer->id,
        ]);
    }

    
}
