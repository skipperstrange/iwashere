<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lecturers;

class CoursesLecturers extends Model
{
    use HasFactory;
    function lectures(){
        return $this->hasMany(Lecturers::class);
    }

}
