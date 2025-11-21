<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">My Courses</h2>
                <a href="{{ route('admin.courses.create') }}" class="lms-btn-primary">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Create New Course
                </a>
            </div>

            @if($courses->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($courses as $course)
                        <div class="lms-card overflow-hidden">
                            @if($course->image)
                                <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="w-full h-48 object-cover">
                            @endif
                            <div class="p-6">
                                <h3 class="font-bold text-xl text-gray-900 mb-3">{{ $course->title }}</h3>
                                <p class="text-sm text-gray-600 mb-2">{{ $course->lessons->count() }} Lessons</p>
                                <p class="text-sm text-gray-600 mb-4">{{ $course->enrollments->count() }} Students</p>
                                <span class="lms-badge {{ $course->is_published ? 'lms-badge-success' : 'lms-badge-warning' }} mb-4">
                                    {{ $course->is_published ? 'Published' : 'Draft' }}
                                </span>
                                <div class="flex gap-3 mb-4">
                                    <a href="{{ route('admin.courses.edit', $course) }}" class="lms-btn-secondary">Edit</a>
                                    <a href="{{ route('courses.show', $course) }}" class="lms-btn-secondary">View</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="lms-card p-8 text-center">
                    <p class="text-gray-600 text-lg">No courses yet. Create your first one!</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>