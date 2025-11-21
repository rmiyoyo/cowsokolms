<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">My Courses</h2>
          
            @if($enrolledCourses->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($enrolledCourses as $course)
                        <div class="lms-card overflow-hidden">
                            @if($course->image)
                                <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="w-full h-48 object-cover">
                            @endif
                            <div class="p-6">
                                <h3 class="font-bold text-xl text-gray-900 mb-3">{{ $course->title }}</h3>
                                <div class="mb-6">
                                    <div class="w-full bg-gray-200 rounded-full h-4 mb-2">
                                        <div class="lms-progress-bar" style="width: {{ $course->getProgressForUser(auth()->id()) }}%"></div>
                                    </div>
                                    <p class="text-sm text-gray-600 text-center">{{ $course->getProgressForUser(auth()->id()) }}% Complete</p>
                                </div>
                                <a href="{{ route('courses.show', $course) }}" class="text-blue-600 hover:underline font-medium">Continue Learning →</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="lms-card p-8 text-center mb-12">
                    <p class="text-gray-600 text-lg">You haven't enrolled in any courses yet.</p>
                </div>
            @endif

            <h2 class="text-3xl font-bold text-gray-900 mb-8">Available Courses</h2>
            @if($availableCourses->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($availableCourses as $course)
                        <div class="lms-card overflow-hidden">
                            @if($course->image)
                                <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="w-full h-48 object-cover">
                            @endif
                            <div class="p-6">
                                <h3 class="font-bold text-xl text-gray-900 mb-3">{{ $course->title }}</h3>
                                <p class="text-gray-600 text-sm mb-6">{{ Str::limit($course->description, 100) }}</p>
                                <a href="{{ route('courses.show', $course) }}" class="lms-btn-primary w-full text-center">View Course</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="lms-card p-8 text-center">
                    <p class="text-gray-600 text-lg">No available courses at the moment.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>