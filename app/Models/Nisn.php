<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nisn extends Model
{
    protected $fillable = ['student_id', 'nisn'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
