<?php

namespace Database\Seeders;

use App\Models\User;
use Diatria\LaravelInstant\Models\Permission;
use Diatria\LaravelInstant\Models\Role;
use Diatria\LaravelInstant\Models\RolePermission;
use Diatria\LaravelInstant\Utils\Permission as UtilsPermission;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        DB::table('role_permissions')->truncate();
        DB::table('permissions')->truncate();

        $permissions = [
            'can_create_management_units',
            'can_view_management_units',
            'can_update_management_units',
            'can_delete_management_units',

            'can_create_users',
            'can_view_users',
            'can_update_users',
            'can_delete_users',

            'can_create_units',
            'can_view_units',
            'can_update_units',
            'can_delete_units',

            'can_create_unit_details',
            'can_view_unit_details',
            'can_update_unit_details',
            'can_delete_unit_details'
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }

        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt(123456),
            'role_id' => Role::create(['name' => 'Super Admin'])->id
        ]);

        User::create([
            'name' => 'Auditor',
            'email' => 'auditor@gmail.com',
            'password' => bcrypt(123456),
            'role_id' => Role::create(['name' => 'Auditor'])->id
        ]);
        
        User::create([
            'name' => 'Unit',
            'email' => 'unit@gmail.com',
            'password' => bcrypt(123456),
            'role_id' => Role::create(['name' => 'Unit'])->id
        ]);

        foreach (DB::table('permissions')->pluck('id') as $permissionID) {
            RolePermission::create([
                'role_id' => 1,
                'permission_id' => $permissionID
            ]);
        }
    }
}
