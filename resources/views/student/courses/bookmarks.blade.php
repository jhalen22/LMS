<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-nature-800 leading-tight flex items-center">
            My Bookmarked Courses
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6 border-l-4 border-nature-500">
                <h3 class="text-2xl font-bold mb-6 text-nature-800 flex items-center">
                    ★ My Bookmarks ({{ $courses->count() }})
                </h3>

                @if($courses->count())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($courses as $course)
                            <div class="card-nature p-6 hover:scale-105 transition-transform duration-200">
                                <div class="flex items-start justify-between mb-3">
                                    <h4 class="font-bold text-lg text-nature-800 flex-1">{{ $course->title }}</h4>
                                    <span class="text-yellow-500 text-xl">★</span>
                                </div>
                                
                                <p class="text-sm text-nature-600 mb-3 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    By: {{ $course->instructor->name }}
                                </p>
                                
                                <p class="text-gray-700 mb-4 line-clamp-3">
                                    {{ Str::limit($course->short_description, 100) }}
                                </p>
                                
                                <div class="flex items-center justify-between pt-4 border-t border-nature-200">
                                    <p class="text-xs text-gray-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                        </svg>
                                        Bookmarked
                                    </p>
                                    <a href="{{ route('student.courses.show', $course) }}" 
                                       class="btn-nature-secondary text-sm">
                                        View Course →
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                        </svg>
                        <p class="text-gray-500 text-lg">You haven't bookmarked any courses yet.</p>
                        <p class="text-gray-400 mt-2">Start exploring and bookmark courses you like!</p>
                        <a href="{{ route('student.courses.index') }}" class="btn-nature-primary mt-4 inline-block">
                            Browse Courses
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
