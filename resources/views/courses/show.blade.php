<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-10">
        <div class="max-w-7xl mx-auto px-4 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">

                <div class="lg:col-span-1 space-y-8">
                    <div class="bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden">
                        @if($course->image)
                            <img src="{{ Storage::url($course->image) }}" class="w-full h-48 object-cover">
                        @endif

                        <div class="p-6 space-y-5">
                            <h1 class="text-xl font-bold text-gray-900 leading-tight">{{ $course->title }}</h1>

                            <div class="text-sm text-gray-700 space-y-1">
                                <div class="font-medium">{{ $course->instructor->name }}</div>
                                <div class="text-gray-500">{{ $course->category ?? 'General' }}</div>
                            </div>

                            @if(!$enrolled)
                                <form method="POST" action="{{ route('courses.enroll', $course) }}">
                                    @csrf
                                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">
                                        Enroll Now
                                    </button>
                                </form>
                            @else
                                <div>
                                    <div class="text-sm font-semibold text-blue-600">{{ $progress }}% Complete</div>
                                    <div class="w-full bg-blue-100 rounded-full h-3 mt-2 overflow-hidden">
                                        <div style="width: {{ $progress }}%" class="h-3 bg-blue-600 rounded-full"></div>
                                    </div>
                                </div>

                                <a href="#content" class="block text-center bg-gray-900 text-white py-3 rounded-lg mt-4 font-medium hover:bg-black transition">
                                    Continue Learning
                                </a>
                            @endif
                        </div>
                    </div>

                    @if($enrolled)
                        <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Course Stats</h3>
                            <div class="space-y-3 text-sm text-gray-700">
                                <div class="flex justify-between"><span>Lessons</span><span>{{ $course->lessons->count() }}</span></div>
                                <div class="flex justify-between"><span>Quizzes</span><span>{{ $course->quizzes->count() }}</span></div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="lg:col-span-3 space-y-12">

                    <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-5">About This Course</h2>
                        <p class="text-gray-700 leading-relaxed text-lg">{{ $course->description }}</p>
                    </div>

                    @if($enrolled)
                        <div id="content" class="space-y-12">

                            <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-8">
                                <div class="flex items-center justify-between mb-6">
                                    <h2 class="text-2xl font-bold text-gray-900">Lessons</h2>
                                    <span class="text-sm text-gray-500">{{ $course->lessons->count() }} total</span>
                                </div>

                                <div class="space-y-4">
                                    @foreach($course->lessons as $index => $lesson)
                                        <div class="border border-gray-200 rounded-lg p-4 flex items-center justify-between hover:border-blue-300 transition">
                                            <div class="flex items-center gap-4">
                                                <div class="w-11 h-11 bg-blue-100 text-blue-700 rounded-lg flex items-center justify-center font-bold text-sm">
                                                    {{ $index + 1 }}
                                                </div>

                                                <div>
                                                    <a href="{{ route('lessons.show', $lesson) }}" class="font-semibold text-gray-900 hover:text-blue-600">
                                                        {{ $lesson->title }}
                                                    </a>

                                                    <div class="flex items-center gap-3 mt-1 text-xs text-gray-500">
                                                        <span class="bg-gray-100 px-2 py-1 rounded">{{ ucfirst($lesson->type) }}</span>

                                                        @if($lesson->isCompletedBy(auth()->id()))
                                                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded flex items-center gap-1">
                                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                                                </svg>
                                                                Completed
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <a href="{{ route('lessons.show', $lesson) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center gap-1">
                                                Start
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-8">
                                <div class="flex items-center justify-between mb-6">
                                    <h2 class="text-2xl font-bold text-gray-900">Assessments</h2>
                                    <span class="text-sm text-gray-500">{{ $course->quizzes->count() }} quizzes</span>
                                </div>

                                <div class="space-y-4">
                                    @foreach($course->quizzes as $quiz)
                                        <div class="border border-gray-200 p-4 rounded-lg hover:border-blue-300 transition">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <h3 class="font-semibold text-gray-900 mb-1">{{ $quiz->title }}</h3>
                                                    <div class="flex items-center gap-4 text-sm text-gray-600">
                                                        <span>Pass Score: {{ $quiz->pass_score }}%</span>
                                                        <span>{{ $quiz->questions->count() }} Questions</span>
                                                    </div>
                                                </div>

                                                <a href="{{ route('quizzes.show', $quiz) }}" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-medium transition">
                                                    Take Quiz
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    @endif

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
