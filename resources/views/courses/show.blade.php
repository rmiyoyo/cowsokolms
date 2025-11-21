<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="lms-card p-8 mb-8">
                @if($course->image)
                    <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="w-full h-64 object-cover rounded-lg mb-6">
                @endif
                <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $course->title }}</h1>
                <p class="text-gray-600 text-lg mb-6">{{ $course->description }}</p>
                <p class="text-sm text-gray-600 mb-8">Instructor: {{ $course->instructor->name }}</p>
              
                @if(!$enrolled)
                    <form method="POST" action="{{ route('courses.enroll', $course) }}" class="inline">
                        @csrf
                        <button type="submit" class="lms-btn-primary">Enroll Now</button>
                    </form>
                @else
                    <div class="mb-8">
                        <div class="w-full bg-gray-200 rounded-full h-4 mb-2">
                            <div class="lms-progress-bar" style="width: {{ $progress }}%"></div>
                        </div>
                        <p class="text-sm text-gray-600 text-center">{{ $progress }}% Complete</p>
                    </div>
                @endif
            </div>
            @if($enrolled)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="lms-card p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Lessons</h2>
                        @foreach($course->lessons as $lesson)
                            <div class="border-b border-gray-200 pb-6 mb-6 last:border-b-0 last:mb-0">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="flex-1">
                                        <a href="{{ route('lessons.show', $lesson) }}" class="font-bold text-gray-900 hover:text-blue-600">
                                            {{ $lesson->title }}
                                        </a>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-xs text-gray-500">{{ ucfirst($lesson->type) }}</span>
                                            @if($lesson->isCompletedBy(auth()->id()))
                                                <span class="lms-badge lms-badge-success text-xs">✓ Completed</span>
                                            @endif
                                        </div>
                                    </div>
                                    <a href="{{ route('lessons.show', $lesson) }}" class="lms-btn-primary text-sm ml-4">
                                        View
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="lms-card p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Quizzes</h2>
                        @foreach($course->quizzes as $quiz)
                            <div class="border-b border-gray-200 pb-6 mb-6 last:border-b-0 last:mb-0 flex justify-between items-center">
                                <div>
                                    <h3 class="font-bold text-gray-900">{{ $quiz->title }}</h3>
                                    <span class="text-xs text-gray-500">Pass Score: {{ $quiz->pass_score }}%</span>
                                </div>
                                <a href="{{ route('quizzes.show', $quiz) }}" class="lms-btn-primary text-sm">Take Quiz</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>