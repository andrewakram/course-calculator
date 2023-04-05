<?php

namespace Database\Seeders;

use App\Models\TeacherApppintment;
use App\Models\TeacherInfo;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 6; $i++) {
            User::create([
                'type' => "user",
                'active' => 1,
                'name' => "user".$i,
                'email' => "user".$i.'@gmail.com',
                'phone' => "123456".$i,
                'password' => bcrypt('123456')
            ]);
        }
    }
}
