<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Instructor Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-end mb-4">
                <a href="{{ route('instructor.courses.create') }}"
                   class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    + Create Course
                </a>
            </div>

            <div class="bg-white shadow rounded p-6">
                <h3 class="text-lg font-semibold mb-4">My Courses</h3>

                @if($courses->count())
                    <table class="w-full border">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-2 border">Title</th>
                                <th class="p-2 border">Created</th>
                                <th class="p-2 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                                <tr>
                                    <td class="p-2 border">{{ $course->title }}</td>
                                    <td class="p-2 border">{{ $course->created_at->format('M d, Y') }}</td>
                                    <td class="p-2 border">
                                        <a href="#" class="text-blue-600">Edit</a> |
                                        <a href="#" class="text-red-600">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-500">You haven’t created any courses yet.</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>

