<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\StudentCourses;
use App\Models\Programmes;
use App\Models\Courses;
use App\Models\ProgrammesCourses;

class Students extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
    'name',
    'email',
    'username',
    'password',
    'current_level',
    'programme_id'
    ];

    protected static function booted()
    {
        static::created(function ($student) {
            $programmeId = $student->programme_id;

            // Retrieve the courses associated with the programme
            $programmeCourses = ProgrammesCourses::where('programme_id', $programmeId)->pluck('course_id');

            // Attach the courses to the student
            $student->courses()->attach($programmeCourses);
        });
    }

    function courses(){
        return $this->belongsToMany(Courses::class, 'student_courses', 'student_id', 'course_id');
    }

    function programme(){
        return $this->belongsTo(Programmes::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
