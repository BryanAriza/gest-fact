<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TypeDocumentSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserTableSeeder::class);


        $user = User::find(1);
        $user->assignRole('ADMIN');

        $user = User::find(2);
        $user->assignRole('FACTURADOR');


        $permissions = [
                'Gest_Index',
                'Product_Index',
                'Category_Index',
                'Sales_Index',
                'User_Index',
                'Config_Index',
                'Role_Index',
                'Permission_Index',
                'Asignar_Index',
                'Customer_Index',
                'Reports_Index',
                'Product_Create',
                'Product_Update',
                'Product_Destroy',
                'Product_Search',
                'Category_Create',
                'Category_Update',
                'Category_Destroy',
                'Category_Search',
                'Sales_Create',
                'Sales_Update',
                'Sales_Destroy',
                'Sales_Search',
                'User_Create',
                'User_Update',
                'User_Destroy',
                'User_Search',
                'Customer_Create',
                'Customer_Delete',
                'Customer_Update',
                'Customer_Search',
                'Role_Create',
                'Role_Update',
                'Role_Destroy',
                'Role_Search',
                'Permission_Create',
                'Permission_Update',
                'Permission_Destroy',
                'Permission_Search',
                'Asignar_Create',
                'Asignar_Update',
                'Asignar_Destroy',
                'Asignar_Search'             

            ];

            foreach ($permissions as $permission) {
                Permission::create(['name' => $permission]);
            }

            //permisos para el rol admin
            $role = Role::find(1);
            $role->givePermissionTo('Gest_Index');
            $role->givePermissionTo('Product_Index');
            $role->givePermissionTo('Category_Index');
            $role->givePermissionTo('Sales_Index');
            $role->givePermissionTo('User_Index');
            $role->givePermissionTo('Config_Index');
            $role->givePermissionTo('Role_Index');
            $role->givePermissionTo('Permission_Index');
            $role->givePermissionTo('Asignar_Index');
            $role->givePermissionTo('Customer_Index');
            $role->givePermissionTo('Reports_Index');
            $role->givePermissionTo('Product_Create');
            $role->givePermissionTo('Product_Update');
            $role->givePermissionTo('Product_Destroy');
            $role->givePermissionTo('Product_Search');
            $role->givePermissionTo('Category_Create');
            $role->givePermissionTo('Category_Update');
            $role->givePermissionTo('Category_Destroy');
            $role->givePermissionTo('Category_Search');
            $role->givePermissionTo('Sales_Create');
            $role->givePermissionTo('Sales_Update');
            $role->givePermissionTo('Sales_Destroy');
            $role->givePermissionTo('Sales_Search');
            $role->givePermissionTo('User_Create');
            $role->givePermissionTo('User_Update');
            $role->givePermissionTo('User_Destroy');
            $role->givePermissionTo('User_Search');
            $role->givePermissionTo('Customer_Create');
            $role->givePermissionTo('Customer_Delete');
            $role->givePermissionTo('Customer_Update');
            $role->givePermissionTo('Customer_Search');
            $role->givePermissionTo('Role_Create');
            $role->givePermissionTo('Role_Update');
            $role->givePermissionTo('Role_Destroy');
            $role->givePermissionTo('Role_Search');
            $role->givePermissionTo('Permission_Create');
            $role->givePermissionTo('Permission_Update');
            $role->givePermissionTo('Permission_Destroy');
            $role->givePermissionTo('Permission_Search');
            $role->givePermissionTo('Asignar_Create');
            $role->givePermissionTo('Asignar_Update');
            $role->givePermissionTo('Asignar_Destroy');
            $role->givePermissionTo('Asignar_Search');
            

             //permisos para el rol facturador
            $role1 = Role::find(2);
            $role1->givePermissionTo('Gest_Index');
            $role1->givePermissionTo('Product_Index');
            $role1->givePermissionTo('Category_Index');
            $role1->givePermissionTo('Sales_Index');
            $role1->givePermissionTo('Config_Index');
            $role1->givePermissionTo('Customer_Index');
            $role1->givePermissionTo('Product_Create');
            $role1->givePermissionTo('Product_Update');
            $role1->givePermissionTo('Product_Search');
            $role1->givePermissionTo('Category_Create');
            $role1->givePermissionTo('Category_Update');
            $role1->givePermissionTo('Category_Search');
            $role1->givePermissionTo('Sales_Create');
            $role1->givePermissionTo('Sales_Search');
            $role1->givePermissionTo('Customer_Create');
            $role1->givePermissionTo('Customer_Update');
            $role1->givePermissionTo('Customer_Search');
    }
}
