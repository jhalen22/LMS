<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'short_description', 
        'full_content',      
        'thumbnail', 
        'video_url',
        'pdf_file',        
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
public function students()
{
    return $this->belongsToMany(User::class, 'course_user')
        ->withPivot(['is_bookmarked', 'is_completed'])
        ->withTimestamps();
}

public function isBookmarkedBy($userId)
{
    return $this->students()
        ->where('user_id', $userId)
        ->wherePivot('is_bookmarked', true)
        ->exists();
}

public function isCompletedBy($userId)
{
    return $this->students()
        ->where('user_id', $userId)
        ->wherePivot('is_completed', true)
        ->exists();
}
}