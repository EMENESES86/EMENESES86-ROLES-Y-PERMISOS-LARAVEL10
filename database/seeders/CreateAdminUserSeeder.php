<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'cedula' => '1714355482',
            'name' => 'EDISON FERNANDO',
            'lastname' => 'MENESES TORRES',
            'email' => 'emeneses.developers@gmail.com',
            'avatar' => 'EM_LOGO.jpg',
            'password' => bcrypt('123456'),
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
