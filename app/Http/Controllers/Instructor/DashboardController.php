<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
    $courses = Course::where('user_id', Auth::id())->get();
    return view('instructor.dashboard', compact('courses'));
    }
}
