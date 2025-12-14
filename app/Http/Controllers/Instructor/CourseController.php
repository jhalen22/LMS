<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function create()
    {
        return view('instructor.courses.create');
    }

       public function store(Request $request)
        {
    $request->validate([
        'title' => ['required', 'string', 'max:255'],
        'short_description' => ['required', 'string', 'max:500'],
        'full_content' => ['required', 'string'],
        'video_url' => ['nullable', 'url'],
        'pdf_file' => ['nullable', 'mimes:pdf', 'max:10240'], // 10MB max
    ]);

    $data = [
        'user_id' => Auth::id(),
        'title' => $request->title,
        'short_description' => $request->short_description,
        'full_content' => $request->full_content,
        'video_url' => $request->video_url,
    ];

    // Handle PDF upload
    if ($request->hasFile('pdf_file')) {
        $data['pdf_file'] = $request->file('pdf_file')->store('pdfs', 'public');
    }

    Course::create($data);

    return redirect()
        ->route('instructor.dashboard')
        ->with('success', 'Course created successfully!');
        }

    public function edit(Course $course)
    {
        
        if ($course->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('instructor.courses.edit', compact('course'));
    }

    
public function update(Request $request, Course $course)
{
    if ($course->user_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'title' => ['required', 'string', 'max:255'],
        'short_description' => ['required', 'string', 'max:500'],
        'full_content' => ['required', 'string'],
        'video_url' => ['nullable', 'url'],
        'pdf_file' => ['nullable', 'mimes:pdf', 'max:10240'],
    ]);

    $data = [
        'title' => $request->title,
        'short_description' => $request->short_description,
        'full_content' => $request->full_content,
        'video_url' => $request->video_url,
    ];

    // Handle PDF upload
    if ($request->hasFile('pdf_file')) {
        // Delete old PDF
        if ($course->pdf_file) {
            Storage::disk('public')->delete($course->pdf_file);
        }
        $data['pdf_file'] = $request->file('pdf_file')->store('pdfs', 'public');
    }

    $course->update($data);

    return redirect()
        ->route('instructor.dashboard')
        ->with('success', 'Course updated successfully!');
}    


    public function destroy(Course $course)
    {
        
        if ($course->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $course->delete();

        return redirect()
            ->route('instructor.dashboard')
            ->with('success', 'Course deleted successfully!');
    }
}