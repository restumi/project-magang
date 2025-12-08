<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name'];

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public function nisn()
    {
        return $this->hasOne(Nisn::class);
    }

    public function hobbies()
    {
        return $this->belongsToMany(Hobby::class, 'student_hobbies');
    }
}
