<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use DB;
use App;
use App\Models\User;
use Auth;

class AsignarController extends Component
{
    use WithPagination;

    public $role, $user, $componentName,$pageTitle, $permisosSelected = [], $old_permissions = [];
    private $pagination = 10;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->role = 'Elegir';
        $this->user = 'Elegir';

        $this->pageTitle = 'Asignar';
        $this->componentName = 'Permisos';
    }



    public function render()
    {

        $user =  new User();
        if (Auth::user()->hasRole('ADMIN')) {
            $permisos = Permission::select('name', 'id', DB::raw("0 as checked"))
                ->orderBy('name', 'asc')
                ->paginate($this->pagination);
            $showRol = Role::orderBy('name', 'asc')->get();
            $showUser = User::select(DB::raw('CONCAT(first_name," ",last_name) AS name'))->orderBy('name', 'asc')->get();
        } else {
            $permisos = Permission::select('name', 'id', DB::raw("0 as checked"))
                ->whereNotIn('id', [4, 6, 7, 9, 11, 12, 18])
                ->orderBy('name', 'asc')
                ->paginate($this->pagination);
            $showRol = Role::whereNotIn('id', [1])->orderBy('name', 'asc')->get();
            $showUser = User::select(DB::raw('CONCAT(first_name," ",last_name) AS name'))->orderBy('name', 'asc')->whereNotIn('id', [1])->orderBy('name', 'asc')->get();
        }


        if ($this->role != 'Elegir') {
            $list = Permission::join('role_has_permissions as rp', 'rp.permission_id', 'permissions.id')
                ->where('role_id', $this->role)->pluck('permissions.id')->toArray();
            $this->old_permissions = $list;


            foreach ($permisos as $permiso) {
                $role = Role::find($this->role);
                $tienePermiso = $role->hasPermissionTo($permiso->name);
                if ($tienePermiso) {
                    $permiso->checked = 1;
                }
            }
        } else if ($this->user != 'Elegir') {

            $bus = User::where('id', '=', $this->user)->get();

            $list = Permission::join('model_has_permissions as mhp', 'mhp.permission_id', 'permissions.id')
                ->where('mhp.model_id', $this->user)->pluck('permissions.id')->toArray();
            $this->old_permissions = $list;

            foreach ($permisos as $permiso) {
                $user = User::find($this->user);
                $tienePermiso = $user->hasPermissionTo($permiso->name);

                if ($tienePermiso ) {
                    $permiso->checked = 1;
                }
            }
        }
        if ($this->role != 'Elegir' & $this->user != 'Elegir') {
            $this->emit('sync-error', "Solo puedes filtrar por: Roles o Usuarios");
            $this->role = 'Elegir';
            $this->user = 'Elegir';
        }

        return view('livewire.asignar.component', [
            'roles' => $showRol,
            'permisos' => $permisos,
            'users' => $showUser
        ])->extends('layouts.theme.app')->section('content');
    }

    public $listeners = ['revokeall' => 'RemoveAll'];


    public function RemoveAll()
    {
        if ($this->role != 'Elegir') {
            $role = Role::find($this->role);
            $role->syncPermissions([0]);
            $this->emit('removeall', "Se revocaron todos los permisos del role $role->name ");
        } else
        if ($this->user != 'Elegir') {

            $user =  User::find($this->user);
            $user->syncPermissions([0]);

            $this->emit('removeall', "Se revocaron todos los permisos adicionales al usuario $user->name ");
        }
        if ($this->role != 'Elegir' & $this->user != 'Elegir') {
            $this->emit('sync-error', "Solo puedes revocar permisos para: Roles o Usuarios");
            $this->role = 'Elegir';
            $this->user = 'Elegir';
        }


    }


    public function syncAll()
    {
        if ($this->role == 'Elegir' & $this->user == 'Elegir') {
            $this->emit('sync-error', 'Selecciona un role o usuario válido');
            return;
        }else if ($this->role != 'Elegir')
        {
            $role = Role::find($this->role);
            $permisos = Permission::whereNotIn('id', [4, 6, 7, 9, 11, 12, 18])->pluck('id')->toArray();
            $role->syncPermissions($permisos);

            $this->emit('syncall', "Se sincronizaron todos los permisos al role $role->name ");
        }else if($this->user != 'Elegir')
        {
            $user = User::find($this->user);
            $permisos = Permission::whereNotIn('id', [4, 6, 7, 9, 11, 12, 18])->pluck('id')->toArray();
            $user->syncPermissions($permisos);

            $this->emit('syncall', "Se sincronizaron todos los permisos al usuario $user->name ");
        }


    }


    public function syncPermiso($state, $permisoName)
    {
        if ($this->role != 'Elegir') {
            $roleName = Role::find($this->role);

            if ($state) {
                $roleName->givePermissionTo($permisoName);
                $this->emit('permi', "Permiso asignado correctamente ");
            } else {
                $roleName->revokePermissionTo($permisoName);
                $this->emit('permi', "Permiso eliminado correctamente ");
            }
        }else if ($this->user != 'Elegir') {
            $user = User::find($this->user);

            if ($state) {
                $user->givePermissionTo($permisoName);
                $this->emit('permi', "Permiso asignado correctamente ");
            } else {
                $user->revokePermissionTo($permisoName);
                $this->emit('permi', "Permiso eliminado correctamente ");
            }
        }

        else {
            $this->emit('permi', "Elige un role o usuario válido");
        }
    }




}