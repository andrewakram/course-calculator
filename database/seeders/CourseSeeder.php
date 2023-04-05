<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\City;
use App\Models\Course;
use App\Models\CourseCity;
use App\Models\CourseLesson;
use App\Models\CourseSection;
use App\Models\User;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name_ar' => '1كورس لغة عربية',
                'name_en' => 'Arabic Lang Course1',
            ],
            [
                'name_ar' => '2كورس لغة عربية',
                'name_en' => 'Arabic Lang Course2',
            ],
            [
                'name_ar' => '3كورس لغة عربية',
                'name_en' => 'Arabic Lang Course3',
            ],
        ];
        foreach ($data as $get) {
            Course::updateOrCreate($get);
        }
    }
}
