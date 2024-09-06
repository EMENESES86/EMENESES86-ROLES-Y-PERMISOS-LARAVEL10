<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'name' => 'EM_CARNET',
            'short_name' => 'EFMT',
            'favicon' => 'EM_LOGO.jpg',
            'logo'=>'EM_LOGO_BL.png',
        ]);
    }
}
