<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Trainning;


class Student extends Model
{
    use HasFactory;
    
    public function trainning()
    { 
        return $this->belongsTo(Trainning::class); 
    }
}
