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

        $permissions = [
            'can_create_management_units',
            'can_view_management_units',
            'can_update_management_units',
            'can_delete_management_units'
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }

        $role = Role::create([
            'name' => 'Super Admin'
        ]);

        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt(123456),
            'role_id' => $role->id
        ]);

        foreach (DB::table('permissions')->pluck('id') as $permissionID) {
            RolePermission::create([
                'role_id' => $role->id,
                'permission_id' => $permissionID
            ]);
        }
    }
}
