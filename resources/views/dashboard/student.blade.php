<x-app-layout>
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <h1 class="text-3xl font-semibold text-gray-900 mb-2">My Learning</h1>
                <p class="text-gray-600">Track your progress and continue your courses</p>
            </div>
            
            @if($enrolledCourses->count() > 0)
                <div class="mb-16">
                    <h2 class="lms-section-title">In Progress</h2>
                    <div class="lms-course-grid">
                        @foreach($enrolledCourses as $course)
                            <div class="lms-card">
                                @if($course->image)
                                    <img src="{{ Storage::url($course->image) }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gradient-to-br from-blue-500 to-blue-600"></div>
                                @endif
                                <div class="p-6">
                                    <h3 class="font-semibold text-lg text-gray-900 mb-2">{{ $course->title }}</h3>
                                    <p class="text-sm text-gray-600 mb-4">{{ $course->instructor->name ?? 'Instructor' }}</p>
                                    
                                    @php $progress = $course->getProgressForUser(auth()->id()); @endphp
                                    <div class="mb-4">
                                        <div class="flex justify-between text-sm mb-2">
                                            <span class="text-gray-700 font-medium">Progress</span>
                                            <span class="text-gray-900 font-semibold">{{ $progress }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div style="width: {{ $progress }}%" class="lms-progress-bar"></div>
                                        </div>
                                    </div>
                                    
                                    <a href="{{ route('courses.show', $course) }}" class="block text-center bg-gray-900 text-white py-2.5 rounded-lg font-medium text-sm">
                                        Continue Learning
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="lms-card p-12 text-center mb-16">
                    <svg class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <p class="text-gray-600">You haven't enrolled in any courses yet.</p>
                </div>
            @endif
            
            <div>
                <h2 class="lms-section-title">Available Courses</h2>
                @if($availableCourses->count() > 0)
                    <div class="lms-course-grid">
                        @foreach($availableCourses as $course)
                            <div class="lms-card">
                                @if($course->image)
                                    <img src="{{ Storage::url($course->image) }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gradient-to-br from-blue-500 to-blue-600"></div>
                                @endif
                                <div class="p-6">
                                    <h3 class="font-semibold text-lg text-gray-900 mb-2">{{ $course->title }}</h3>
                                    <p class="text-gray-600 text-sm mb-6 line-clamp-3">
                                        {{ Str::limit($course->description, 110) }}
                                    </p>
                                    <a href="{{ route('courses.show', $course) }}" class="block text-center bg-blue-600 text-white py-2.5 rounded-lg font-medium text-sm">
                                        View Course
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="lms-card p-12 text-center">
                        <p class="text-gray-600">No available courses at the moment.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>