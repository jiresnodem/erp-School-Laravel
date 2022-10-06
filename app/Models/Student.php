<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Trainning;
use App\Models\Payment;

class Student extends Model
{
    use HasFactory;
    
    public function trainning()
    { 
        return $this->belongsTo(Trainning::class); 
    }

    public function payment()
    { 
        return $this->belongsTo(Payment::class); 
    }
}
