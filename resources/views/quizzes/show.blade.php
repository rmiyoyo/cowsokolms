<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">{{ $quiz->title }}</h2>
          
            <form method="POST" action="{{ route('quizzes.submit', $quiz) }}" class="lms-card p-8">
                @csrf
              
                @foreach($quiz->questions as $index => $question)
                    <div class="mb-8 pb-8 border-b border-gray-200 last:border-b-0 last:mb-0 last:pb-0">
                        <p class="font-bold text-lg text-gray-900 mb-6">{{ $index + 1 }}. {{ $question->question }}</p>
                      
                        @if($question->type === 'mcq')
                            @foreach($question->options as $key => $option)
                                <label class="block mb-3 flex items-center">
                                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $key }}" required class="mr-3 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <span class="text-gray-700">{{ $key }}. {{ $option }}</span>
                                </label>
                            @endforeach
                        @else
                            <label class="block mb-3 flex items-center">
                                <input type="radio" name="answers[{{ $question->id }}]" value="true" required class="mr-3 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <span class="text-gray-700">True</span>
                            </label>
                            <label class="block mb-3 flex items-center">
                                <input type="radio" name="answers[{{ $question->id }}]" value="false" required class="mr-3 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <span class="text-gray-700">False</span>
                            </label>
                        @endif
                    </div>
                @endforeach
                <button type="submit" class="lms-btn-primary">Submit Quiz</button>
            </form>
        </div>
    </div>
</x-app-layout>