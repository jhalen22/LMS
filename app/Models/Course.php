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
        'description',
    ];

    // Instructor who owns the course
    public function instructor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
