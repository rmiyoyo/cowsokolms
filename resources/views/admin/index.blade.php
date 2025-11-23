<x-app-layout>
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-12">
                <div>
                    <h1 class="text-3xl font-semibold text-gray-900 mb-2">Course Management</h1>
                    <p class="text-gray-600">Create and manage your courses</p>
                </div>
                <a href="{{ route('admin.courses.create') }}" class="lms-btn-primary inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Create Course
                </a>
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
                                <div class="flex items-start justify-between mb-3">
                                    <h3 class="font-semibold text-lg text-gray-900">{{ $course->title }}</h3>
                                    <span class="lms-badge {{ $course->is_published ? 'lms-badge-success' : 'lms-badge-warning' }}">
                                        {{ $course->is_published ? 'Published' : 'Draft' }}
                                    </span>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-3 mb-6">
                                    <div class="bg-gray-50 rounded-lg p-3 text-center">
                                        <div class="text-2xl font-semibold text-gray-900">{{ $course->lessons->count() }}</div>
                                        <div class="text-xs text-gray-600">Lessons</div>
                                    </div>
                                    <div class="bg-gray-50 rounded-lg p-3 text-center">
                                        <div class="text-2xl font-semibold text-gray-900">{{ $course->enrollments->count() }}</div>
                                        <div class="text-xs text-gray-600">Students</div>
                                    </div>
                                </div>
                                
                                <div class="flex gap-2 mb-4">
                                    <a href="{{ route('admin.courses.edit', $course) }}" class="flex-1 text-center lms-btn-secondary text-sm py-2">Edit</a>
                                    <a href="{{ route('courses.show', $course) }}" class="flex-1 text-center lms-btn-secondary text-sm py-2">View</a>
                                </div>
                                
                                <div class="border-t border-gray-200 pt-4 space-y-2">
                                    <a href="{{ route('admin.lessons.create', $course) }}" class="block text-blue-600 text-sm font-medium">+ Add Lesson</a>
                                    <a href="{{ route('admin.quizzes.create', $course) }}" class="block text-blue-600 text-sm font-medium">+ Add Quiz</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="lms-card p-12 text-center">
                    <svg class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <p class="text-gray-600 mb-4">No courses yet. Start by creating one!</p>
                    <a href="{{ route('admin.courses.create') }}" class="lms-btn-primary inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Create Course
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>