<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
            'name1' => 'EDISON',
            'name2' => 'FERNANDO',
            'lastname1' => 'MENESES',
            'lastname2' => 'TORRES',
            'email' => 'emeneses.developers@gmail.com',
            'avatar' => 'EM_LOGO.jpg',
            'password' => bcrypt('123456')
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
