<?php

namespace App\Models;

use App\Models\Trainning;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slice extends Model
{
    use HasFactory;

    public function trainning() 
    { 
        return $this->belongsTo(Trainning::class); 
    }
}
