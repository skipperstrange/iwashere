<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Students;
use App\Models\Programmes;
use App\Models\Lecturers;


class Courses extends Model
{
    use HasFactory;

    protected $fillable = [
    'code',
    'name',
    'credit_unit',
    'course_desc',
    'course_start',
    'course_end',
    ];

    public function lecturers()
    {
        return $this->belongsToMany(Lecturers::class, 'courses_lecturers');
    }

    public function programmes()
    {
        return $this->belongsToMany(Programmes::class);
    }

    public function students()
    {
        return $this->belongsToMany(Students::class);
    }

}
