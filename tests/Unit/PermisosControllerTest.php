<?php

use App\Http\Livewire\PermisosController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PermisosControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_cannot_delete_a_permission_associated_with_roles()
    {
        // Crear un permiso y un rol asociado en la base de datos
        $permission = Permission::create(['name' => 'test_permission']);
        $role = Role::create(['name' => 'test_role']);
        $role->givePermissionTo($permission);

        Livewire::test(PermisosController::class)
            ->call('Destroy', $permission->id)
            ->assertEmitted('permiso-error');
    }

    
}
