<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }

}
