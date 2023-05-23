<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Courses;

class Programmes extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'programme_code',
        'desc',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'programmes_courses', 'programme_id', 'course_id');
    }

    public function students()
    {
        return $this->belongsToMany(Students::class, 'programmes_courses', 'programme_id', 'course_id');
    }
}
