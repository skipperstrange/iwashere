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
        return $this->belongsToMany(Courses::class, 'programmes_courses', 'programme_id', 'course_id');
    }


}
