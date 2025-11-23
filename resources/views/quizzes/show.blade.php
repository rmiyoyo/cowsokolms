<x-app-layout>
    <div class="py-12 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-semibold text-gray-900 mb-2">{{ $quiz->title }}</h1>
                <p class="text-gray-600">Answer all questions to complete this assessment</p>
            </div>
            
            <div class="lms-card p-8 mb-6">
                <div class="flex items-center justify-between bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <div class="font-semibold text-gray-900">{{ $quiz->questions->count() }} Questions</div>
                            <div class="text-sm text-gray-600">Pass Score: {{ $quiz->pass_score }}%</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <form method="POST" action="{{ route('quizzes.submit', $quiz) }}">
                @csrf
                
                <div class="space-y-6">
                    @foreach($quiz->questions as $index => $question)
                        <div class="lms-card p-8">
                            <div class="mb-6">
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-blue-600 text-white rounded-lg flex items-center justify-center font-semibold text-sm mr-4 flex-shrink-0">
                                        {{ $index + 1 }}
                                    </div>
                                    <p class="font-medium text-lg text-gray-900">{{ $question->question }}</p>
                                </div>
                            </div>
                            
                            <div class="ml-12 space-y-3">
                                @if($question->type === 'mcq')
                                    @foreach($question->options as $key => $option)
                                        <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer">
                                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $key }}" required class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-4 text-gray-700"><span class="font-medium">{{ $key }}.</span> {{ $option }}</span>
                                        </label>
                                    @endforeach
                                @else
                                    <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="true" required class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                        <span class="ml-4 text-gray-700 font-medium">True</span>
                                    </label>
                                    <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="false" required class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                        <span class="ml-4 text-gray-700 font-medium">False</span>
                                    </label>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-8">
                    <button type="submit" class="lms-btn-primary w-full">Submit Quiz</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>