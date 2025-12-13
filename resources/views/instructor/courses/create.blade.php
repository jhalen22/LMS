@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Create Course</h2>

        <form method="POST" action="{{ route('instructor.courses.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block mb-1">Course Title</label>
                <input type="text" name="title" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Description</label>
                <textarea name="description" class="w-full border rounded p-2" required></textarea>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Create Course
            </button>
        </form>
    </div>
</div>
@endsection
