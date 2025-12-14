<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_picture',   
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getProfilePictureUrlAttribute()
    {
        return $this->profile_picture
            ? asset('storage/' . $this->profile_picture)
            : asset('images/default-avatar.png');
    }

        // Courses bookmarked or completed by student
        public function courses()
        {
    return $this->belongsToMany(Course::class, 'course_user')
        ->withPivot(['is_bookmarked', 'is_completed'])
        ->withTimestamps();
        }

    public function bookmarkedCourses()
    {
    return $this->courses()->wherePivot('is_bookmarked', true);
    }

    public function completedCourses()
    {
    return $this->courses()->wherePivot('is_completed', true);
    }
}

