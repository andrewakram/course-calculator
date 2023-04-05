<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'type' => "super",
            'active' => 1,
            'name' => "super",
            'email' => "manager@gmail.com",
            'phone' => "123456",
            'password' => bcrypt('123456')
        ]);
        for ($i=1; $i < 6; $i++) {
            Admin::create([
                'type' => "super",
                'active' => 1,
                'name' => "super".$i,
                'email' => "manager".$i.'@gmail.com',
                'phone' => "123456".$i,
                'password' => bcrypt('123456')
            ]);
        }
    }
}
