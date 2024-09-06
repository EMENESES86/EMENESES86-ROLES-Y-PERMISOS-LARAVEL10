<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'users-list',
            'users-create',
            'users-edit',
            'users-delete',
            // 'categoria-list',
            'categoria-create',
            'categoria-edit',
            'categoria-delete',
            // 'producto-list',
            'producto-create',
            'producto-edit',
            'producto-delete',

            // 'administracion-list',
            'administracion-create',
            'administracion-edit',
            'administracion-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
