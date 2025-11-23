<x-app-layout>
    <div class="py-12 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('courses.show', $course) }}" class="inline-flex items-center text-gray-600 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to Course
                </a>
            </div>
            
            <div class="lms-card">
                <div class="p-8 border-b border-gray-200">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h1 class="text-3xl font-semibold text-gray-900 mb-3">{{ $lesson->title }}</h1>
                            <span class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-blue-50 text-blue-700 border border-blue-200">
                                {{ ucfirst($lesson->type) }} Lesson
                            </span>
                        </div>
                        <div>
                            @if($isCompleted)
                                <form method="POST" action="{{ route('lessons.uncomplete', $lesson) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="lms-btn-secondary inline-flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                        </svg>
                                        Completed
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
                </div>
                
                <div class="p-8">
                    @if($lesson->type === 'text')
                        <div class="prose max-w-none text-gray-700 text-lg leading-relaxed">
                            {!! nl2br(e($lesson->content)) !!}
                        </div>
                    @endif
                    
                    @if($lesson->type === 'image' && $lesson->file_path)
                        <div class="mb-8">
                            <img src="{{ Storage::url($lesson->file_path) }}" 
                                 alt="{{ $lesson->title }}" 
                                 class="w-full rounded-lg">
                        </div>
                        @if($lesson->content)
                            <div class="prose max-w-none text-gray-700 text-lg leading-relaxed">
                                {!! nl2br(e($lesson->content)) !!}
                            </div>
                        @endif
                    @endif
                    
                    @if($lesson->type === 'pdf' && $lesson->file_path)
                        <div class="mb-8">
                            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 mb-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <svg class="w-10 h-10 text-red-600 mr-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                                        </svg>
                                        <div>
                                            <p class="font-semibold text-gray-900 text-lg">PDF Document</p>
                                            <p class="text-sm text-gray-600">{{ $lesson->title }}.pdf</p>
                                        </div>
                                    </div>
                                    <a href="{{ Storage::url($lesson->file_path) }}" 
                                       target="_blank"
                                       class="lms-btn-primary">
                                        Open PDF
                                    </a>
                                </div>
                            </div>
                            <iframe src="{{ Storage::url($lesson->file_path) }}" 
                                    class="w-full h-screen rounded-lg border border-gray-300">
                            </iframe>
                        </div>
                        @if($lesson->content)
                            <div class="prose max-w-none text-gray-700 text-lg leading-relaxed mt-8">
                                {!! nl2br(e($lesson->content)) !!}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
            
            <div class="mt-8 flex justify-between items-center">
                @php
                    $allLessons = $course->lessons;
                    $lessonToFind = $lesson;
                    $currentIndex = $allLessons->search(fn($l) => $l->id === $lessonToFind->id);
                    $prevLesson = $currentIndex > 0 ? $allLessons[$currentIndex - 1] : null;
                    $nextLesson = $currentIndex < $allLessons->count() - 1 ? $allLessons[$currentIndex + 1] : null;
                @endphp
                
                @if($prevLesson)
                    <a href="{{ route('lessons.show', $prevLesson) }}" class="lms-btn-secondary inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Previous Lesson
                    </a>
                @else
                    <div></div>
                @endif
                
                @if($nextLesson)
                    <a href="{{ route('lessons.show', $nextLesson) }}" class="lms-btn-primary inline-flex items-center">
                        Next Lesson
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @else
                    <div></div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>