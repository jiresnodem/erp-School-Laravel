<?php

namespace App\Models;

use App\Models\Slice;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trainning extends Model
{
    use HasFactory;

    public function students() 
    { 
        return $this->hasMany(Student::class); 
    }

    public function slices() 
    { 
        return $this->hasMany(Slice::class); 
    }
}
