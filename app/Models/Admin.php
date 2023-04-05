<?php

namespace App\Models;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'password', 'active', 'suspend', 'image', 'type'];


    public function blog(){
        return $this->hasMany(Blog::class);
    }

//    public function setPasswordAttribute($password)
//    {
//        if (!empty($password)) {
//            $this->attributes['password'] = bcrypt($password);
//        } else {
//            $this->attributes['password'] = bcrypt('123456');
//        }
//    }

    public function getImageAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/Admin') . '/' . $image;
        }
        return asset('default.png');
    }

    public function setImageAttribute($image)
    {
        if (is_file($image)) {
            $img_name = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/Admin/'), $img_name);
            $this->attributes['image'] = $img_name;
        } else {
            $this->attributes['image'] = $image;
        }

    }
}
