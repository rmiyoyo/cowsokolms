<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">All Courses</h2>
          
            @if($courses->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($courses as $course)
                        <div class="lms-card overflow-hidden">
                            @if($course->image)
                                <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="w-full h-48 object-cover">
                            @endif
                            <div class="p-6">
                                <h3 class="font-bold text-xl text-gray-900 mb-3">{{ $course->title }}</h3>
                                <p class="text-sm text-gray-600 mb-3">by {{ $course->instructor->name }}</p>
                                <p class="text-gray-600 text-sm mb-6">{{ Str::limit($course->description, 100) }}</p>
                                <a href="{{ route('courses.show', $course) }}" class="lms-btn-primary w-full text-center">View Course</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="lms-card p-8 text-center">
                    <p class="text-gray-600 text-lg">No courses available yet.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>