<x-app-layout>
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <h1 class="text-3xl font-semibold text-gray-900 mb-2">All Courses</h1>
                <p class="text-gray-600">Explore our catalog of courses</p>
            </div>
            
            @if($courses->count() > 0)
                <div class="lms-course-grid">
                    @foreach($courses as $course)
                        <div class="lms-card">
                            @if($course->image)
                                <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-blue-500 to-blue-600"></div>
                            @endif
                            <div class="p-6">
                                <h3 class="font-semibold text-lg text-gray-900 mb-2">{{ $course->title }}</h3>
                                <p class="text-sm text-gray-600 mb-4">{{ $course->instructor->name }}</p>
                                <p class="text-gray-600 text-sm mb-6 line-clamp-3">{{ Str::limit($course->description, 100) }}</p>
                                <a href="{{ route('courses.show', $course) }}" class="block text-center lms-btn-primary w-full">View Course</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="lms-card p-12 text-center">
                    <svg class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <p class="text-gray-600">No courses available yet.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>