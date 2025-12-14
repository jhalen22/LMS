<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-nature-800 leading-tight flex items-center">
            Course Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- ✅ Success Message --}}
            @if(session('success'))
                <div class="bg-nature-100 border-l-4 border-nature-500 text-nature-800 px-4 py-3 rounded mb-4 shadow">
                    <p class="font-medium">✓ {{ session('success') }}</p>
                </div>
            @endif

            {{-- ✅ Back + Actions --}}
            <div class="mb-4 flex justify-between items-center">
                <a href="{{ route('student.courses.index') }}" class="text-nature-600 hover:text-nature-800 font-medium flex items-center">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Courses
                </a>

                <div class="flex gap-2">
                    <!-- Bookmark Button -->
                    <form method="POST" action="{{ route('student.courses.bookmark', $course) }}">
                        @csrf
                        <button
                            type="submit"
                            class="px-4 py-2 rounded-md font-medium transition
                            {{ $course->is_bookmarked
                                ? 'bg-nature-500 text-white'
                                : 'border-2 border-nature-600 text-nature-700 hover:bg-nature-50' }}">
                            {{ $course->is_bookmarked ? '★ Bookmarked' : '☆ Bookmark' }}
                        </button>
                    </form>

                    <!-- Complete Button -->
                    <form method="POST" action="{{ route('student.courses.complete', $course) }}">
                        @csrf
                        <button
                            type="submit"
                            class="px-4 py-2 bg-nature-700 text-white rounded-md hover:bg-nature-800 transition {{ $course->is_completed ? 'opacity-75' : '' }}">
                            {{ $course->is_completed ? '✓ Completed' : 'Mark Complete' }}
                        </button>
                    </form>
                </div>
            </div>

            <div class="bg-white shadow-xl rounded-lg overflow-hidden border-l-4 border-nature-500">
                <!-- Header Section -->
                <div class="bg-gradient-to-r from-nature-700 to-nature-600 p-8 text-white">
                    <h1 class="text-4xl font-bold mb-3">{{ $course->title }}</h1>
                    <div class="flex items-center text-nature-100">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="font-medium">Instructor: {{ $course->instructor->name }}</span>
                    </div>
                </div>

                <!-- Course Info -->
                <div class="p-8">
                    <!-- Short Description -->
                    <div class="mb-8 p-6 bg-nature-50 rounded-lg border-l-4 border-nature-400">
                        <h3 class="font-semibold text-lg mb-3 text-nature-800 flex items-center">
                            About This Course
                        </h3>
                        <p class="text-gray-700 leading-relaxed">{{ $course->short_description }}</p>
                    </div>

                    <!-- Meta Info -->
                    <div class="mb-8 flex flex-wrap gap-6 text-sm text-gray-600">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-nature-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span><strong>Created:</strong> {{ $course->created_at->format('M d, Y') }}</span>
                        </div>

                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-nature-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            <span><strong>Last Updated:</strong> {{ $course->updated_at->format('M d, Y') }}</span>
                        </div>
                    </div>

                    {{-- ✅ Video Embed --}}
                    @if($course->video_url)
                        <div class="mb-8">
                            <h3 class="font-semibold text-2xl mb-4 text-nature-800">Course Video</h3>
                            <div class="aspect-video">
                                @php
                                    $videoUrl = $course->video_url;

                                    // Convert YouTube watch URL to embed URL
                                    if (str_contains($videoUrl, 'youtube.com/watch')) {
                                        parse_str(parse_url($videoUrl, PHP_URL_QUERY), $params);
                                        $videoUrl = 'https://www.youtube.com/embed/' . ($params['v'] ?? '');
                                    }
                                @endphp

                                <iframe class="w-full h-full rounded-lg" src="{{ $videoUrl }}" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                    @endif

                    {{-- ✅ PDF Download --}}
                    @if($course->pdf_file)
                        <div class="mb-8">
                            <h3 class="font-semibold text-2xl mb-4 text-nature-800">Course Materials</h3>
                            <a href="{{ asset('storage/' . $course->pdf_file) }}" target="_blank" class="btn-nature-secondary flex items-center w-fit">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Download PDF Resource
                            </a>
                        </div>
                    @endif
                            <!-- Course Content -->
                    <div class="border-t-2 border-nature-200 pt-8">
                        <h3 class="font-semibold text-2xl mb-6 text-nature-800 flex items-center">
                            <span class="text-3xl mr-2">📚</span>
                            Course Content
                        </h3>
                        <div class="prose max-w-none bg-gray-50 p-6 rounded-lg">
                            <div class="text-gray-800 leading-relaxed whitespace-pre-line">
                                {!! nl2br(e($course->full_content)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>