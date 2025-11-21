<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('courses.show', $course) }}" class="text-blue-600 hover:underline">
                    ← Back to Course
                </a>
            </div>

            <div class="lms-card p-8">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $lesson->title }}</h1>
                        <span class="lms-badge">{{ ucfirst($lesson->type) }} Lesson</span>
                    </div>
                    <div>
                        @if($isCompleted)
                            <form method="POST" action="{{ route('lessons.uncomplete', $lesson) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="lms-btn-secondary">
                                    Mark as Incomplete
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('lessons.complete', $lesson) }}" class="inline">
                                @csrf
                                <button type="submit" class="lms-btn-primary">
                                    Mark as Complete
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <div class="prose max-w-none">
                    @if($lesson->type === 'text')
                        <div class="text-gray-700 leading-relaxed">
                            {!! nl2br(e($lesson->content)) !!}
                        </div>
                    @endif

                    @if($lesson->type === 'image' && $lesson->file_path)
                        <div class="mb-6">
                            <img src="{{ Storage::url($lesson->file_path) }}" 
                                 alt="{{ $lesson->title }}" 
                                 class="w-full rounded-lg shadow-lg">
                        </div>
                        @if($lesson->content)
                            <div class="text-gray-700 leading-relaxed mt-6">
                                {!! nl2br(e($lesson->content)) !!}
                            </div>
                        @endif
                    @endif

                    @if($lesson->type === 'pdf' && $lesson->file_path)
                        <div class="mb-6">
                            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <svg class="w-8 h-8 text-red-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                                        </svg>
                                        <div>
                                            <p class="font-semibold text-gray-900">PDF Document</p>
                                            <p class="text-sm text-gray-600">{{ $lesson->title }}.pdf</p>
                                        </div>
                                    </div>
                                    <a href="{{ Storage::url($lesson->file_path) }}" 
                                       target="_blank"
                                       class="lms-btn-primary">
                                        View PDF
                                    </a>
                                </div>
                            </div>
                            <iframe src="{{ Storage::url($lesson->file_path) }}" 
                                    class="w-full h-screen mt-4 rounded-lg border border-gray-300">
                            </iframe>
                        </div>
                        @if($lesson->content)
                            <div class="text-gray-700 leading-relaxed mt-6">
                                {!! nl2br(e($lesson->content)) !!}
                            </div>
                        @endif
                    @endif
                </div>
            </div>

            <div class="mt-6 flex justify-between items-center">
                @php
                    $allLessons = $course->lessons;
                    $lessonToFind = $lesson;
                    $currentIndex = $allLessons->search(fn($l) => $l->id === $lessonToFind->id);
                    $prevLesson = $currentIndex > 0 ? $allLessons[$currentIndex - 1] : null;
                    $nextLesson = $currentIndex < $allLessons->count() - 1 ? $allLessons[$currentIndex + 1] : null;
                @endphp

                @if($prevLesson)
                    <a href="{{ route('lessons.show', $prevLesson) }}" class="lms-btn-secondary">
                        ← Previous Lesson
                    </a>
                @else
                    <div></div>
                @endif

                @if($nextLesson)
                    <a href="{{ route('lessons.show', $nextLesson) }}" class="lms-btn-primary">
                        Next Lesson →
                    </a>
                @else
                    <div></div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>