<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityCourse extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }

    public function course(){
        return $this->belongsTo(Course::class,'course_id');
    }

}
