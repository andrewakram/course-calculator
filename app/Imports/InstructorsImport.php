<?php

namespace App\Imports;


use App\Models\Category;
use App\Models\TeacherInfo;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class InstructorsImport implements ToModel,WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $user_email = User::whereEmail($row['email'])->first();
        $user_phone = User::wherePhone($row['phone'])->first();
        $instructor = User::create([
            'name' => $row['name'],
            'email' => isset($user_email) ? '_'. $row['email'] : $row['email'],
            'phone' => isset($user_phone) ? '0'. $row['phone'] : $row['phone'],
            'password' => Hash::make('123456'),
            'type' => 'teacher',
            'active' => 1,
            'gender' => $row['gender'],
        ]);
        if(isset($row['category'])){
            $category = Category::where('title_ar',$row['category'])->first();
        }
        TeacherInfo::create([
            'teacher_id' => $instructor->id,
            'full_name' => $row['name'],
            'national_id' => isset($row['national_id']) ? $row['national_id'] : rand(10000000,99999999),
            'residence_id' => isset($row['residence_id']) ? $row['residence_id'] : rand(10000000,99999999),
            'learn_type' => "remote",
            'categoey_id' => isset($category) ? $category->id : Category::first()->id,
        ]);

    }

}
