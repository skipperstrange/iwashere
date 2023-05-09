<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\StudentCourses;
use App\Models\Programmes;

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

    function student_courses(){
        return $this->hasMany(StudentCourses::class);
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
