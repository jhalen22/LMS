<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('instructor')->latest()->get();
        
        // Add bookmark and completion status
        $courses->each(function ($course) {
            $course->is_bookmarked = $course->isBookmarkedBy(Auth::id());
            $course->is_completed = $course->isCompletedBy(Auth::id());
        });
        
        return view('student.courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        $course->load('instructor');
        $course->is_bookmarked = $course->isBookmarkedBy(Auth::id());
        $course->is_completed = $course->isCompletedBy(Auth::id());
        
        return view('student.courses.show', compact('course'));
    }

    public function toggleBookmark(Course $course)
    {
        $user = Auth::user();
        $pivot = $user->courses()->where('course_id', $course->id)->first();

        if ($pivot && $pivot->pivot->is_bookmarked) {
            // Remove bookmark
            $user->courses()->updateExistingPivot($course->id, [
                'is_bookmarked' => false,
                'bookmarked_at' => null
            ]);
            $message = 'Bookmark removed!';
        } else {
            // Add bookmark
            if ($pivot) {
                $user->courses()->updateExistingPivot($course->id, [
                    'is_bookmarked' => true,
                    'bookmarked_at' => now()
                ]);
            } else {
                $user->courses()->attach($course->id, [
                    'is_bookmarked' => true,
                    'bookmarked_at' => now()
                ]);
            }
            $message = 'Course bookmarked!';
        }

        return back()->with('success', $message);
    }

    public function toggleComplete(Course $course)
    {
        $user = Auth::user();
        $pivot = $user->courses()->where('course_id', $course->id)->first();

        if ($pivot && $pivot->pivot->is_completed) {
            // Mark as incomplete
            $user->courses()->updateExistingPivot($course->id, [
                'is_completed' => false,
                'completed_at' => null
            ]);
            $message = 'Marked as incomplete!';
        } else {
            // Mark as complete
            if ($pivot) {
                $user->courses()->updateExistingPivot($course->id, [
                    'is_completed' => true,
                    'completed_at' => now()
                ]);
            } else {
                $user->courses()->attach($course->id, [
                    'is_completed' => true,
                    'completed_at' => now()
                ]);
            }
            $message = 'Course completed!';
        }

        return back()->with('success', $message);
    }

    public function myBookmarks()
    {
        $courses = Auth::user()->bookmarkedCourses()->with('instructor')->get();
        return view('student.bookmarks', compact('courses'));
    }

    public function myCompletions()
    {
        $courses = Auth::user()->completedCourses()->with('instructor')->get();
        return view('student.completions', compact('courses'));
    }
}