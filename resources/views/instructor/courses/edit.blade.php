<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-nature-800 leading-tight flex items-center">
            Edit Course
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden border-l-4 border-nature-500">
                <div class="bg-gradient-to-r from-nature-600 to-nature-500 p-6">
                    <h3 class="text-white text-2xl font-bold">✏️ Edit Course</h3>
                    <p class="text-nature-100 mt-1">Update your course information</p>
                </div>

                <div class="p-6">
                    <form method="POST" action="{{ route('instructor.courses.update', $course) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label class="block text-nature-800 text-sm font-bold mb-2">
                            Course Title *
                            </label>
                            <input type="text" name="title" value="{{ old('title', $course->title) }}" 
                                   class="input-nature w-full @error('title') border-red-500 @enderror" 
                                   required>
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-nature-800 text-sm font-bold mb-2">
                                Short Description *
                            </label>
                            <textarea name="short_description" rows="3" 
                                      class="input-nature w-full @error('short_description') border-red-500 @enderror" 
                                      required>{{ old('short_description', $course->short_description) }}</textarea>
                            @error('short_description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-nature-800 text-sm font-bold mb-2">
                                📚 Full Course Content *
                            </label>
                            <textarea name="full_content" rows="12" 
                                      class="input-nature w-full @error('full_content') border-red-500 @enderror" 
                                      required>{{ old('full_content', $course->full_content) }}</textarea>
                            @error('full_content')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                                <!-- Video URL -->
                                <div class="mb-6">
                                    <label class="block text-nature-800 text-sm font-bold mb-2">
                                        Video URL (YouTube, Vimeo, etc.) - Optional
                                    </label>
                                    <input type="url" name="video_url" value="{{ old('video_url', $course->video_url) }}"
                                        class="input-nature w-full @error('video_url') border-red-500 @enderror"
                                        placeholder="https://www.youtube.com/watch?v=...">
                                    @error('video_url')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                        <!-- PDF File -->
                                        <div class="mb-6">
                                            <label class="block text-nature-800 text-sm font-bold mb-2">
                                                PDF Resource File - {{ $course->pdf_file ? 'Update' : 'Upload' }} (Optional)
                                            </label>
                                            @if($course->pdf_file)
                                                <p class="text-sm text-gray-600 mb-2">
                                                    Current: <a href="{{ asset('storage/' . $course->pdf_file) }}" target="_blank" class="text-nature-600 hover:underline">View PDF</a>
                                                </p>
                                            @endif
                                            <input type="file" name="pdf_file" accept=".pdf"
                                                class="input-nature w-full @error('pdf_file') border-red-500 @enderror">
                                            <p class="text-xs text-gray-500 mt-1">Max: 10MB</p>
                                            @error('pdf_file')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                            
                                        
                                        <div class="flex gap-3 pt-4 border-t border-nature-200">
                                        <button type="submit" class="btn-nature-primary flex items-center">
                                     <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Update Course
                                         </button>
                                        <a href="{{ route('instructor.dashboard') }}" class="btn-nature-outline">
                                            Cancel
                                        </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>