<x-app-layout>
    <div class="py-12 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-semibold text-gray-900 mb-2">Edit Quiz</h1>
                <p class="text-gray-600">Update quiz settings and questions</p>
            </div>
            
            <form method="POST" action="{{ route('admin.quizzes.update', $quiz) }}" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="lms-card p-8">
                    <div class="space-y-6">
                        <div>
                            <label class="lms-form-label">Quiz Title</label>
                            <input type="text" name="title" value="{{ $quiz->title }}" required class="lms-form-input">
                        </div>
                        
                        <div>
                            <label class="lms-form-label">Pass Score (%)</label>
                            <input type="number" name="pass_score" value="{{ $quiz->pass_score }}" min="0" max="100" required class="lms-form-input">
                        </div>
                    </div>
                </div>
                
                <div>
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-semibold text-gray-900">Questions</h3>
                        <button type="button" onclick="addQuestion()" class="lms-btn-secondary text-sm">+ Add Question</button>
                    </div>
                    
                    <div id="questions-container" class="space-y-6">
                        @foreach($quiz->questions as $index => $question)
                            <div class="lms-card p-6" data-question="{{ $index }}">
                                <div class="flex justify-between items-start mb-4">
                                    <h4 class="font-medium text-gray-900">Question {{ $index + 1 }}</h4>
                                    <button type="button" onclick="removeQuestion(this)" class="text-red-600 text-sm font-medium hover:text-red-800">
                                        Remove
                                    </button>
                                </div>
                                <div class="space-y-4">
                                    <div>
                                        <label class="lms-form-label">Question Text</label>
                                        <textarea name="questions[{{ $index }}][question]" required class="lms-form-input" rows="3">{{ $question->question }}</textarea>
                                    </div>
                                    
                                    <div>
                                        <label class="lms-form-label">Question Type</label>
                                        <select name="questions[{{ $index }}][type]" required class="lms-form-input" onchange="toggleOptionsField(this, {{ $index }})">
                                            <option value="mcq" {{ $question->type == 'mcq' ? 'selected' : '' }}>Multiple Choice</option>
                                            <option value="true_false" {{ $question->type == 'true_false' ? 'selected' : '' }}>True/False</option>
                                        </select>
                                    </div>
                                    
                                    <div id="options-container-{{ $index }}" class="options-section" style="display: {{ $question->type == 'true_false' ? 'none' : 'block' }}">
                                        <label class="lms-form-label">Answer Options</label>
                                        <div class="space-y-2" id="options-list-{{ $index }}">
                                            @if($question->type == 'mcq')
                                                @foreach($question->options as $key => $value)
                                                    <div class="flex gap-2">
                                                        <input type="text" value="{{ $value }}" class="lms-form-input flex-1 option-input" data-key="{{ $key }}" placeholder="Option {{ $key }}">
                                                        <button type="button" onclick="removeOption(this)" class="px-3 py-2 text-red-600 hover:bg-red-50 rounded">✕</button>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <button type="button" onclick="addOption({{ $index }})" class="mt-2 text-sm text-blue-600 font-medium hover:text-blue-800">
                                            + Add Another Option
                                        </button>
                                        <input type="hidden" name="questions[{{ $index }}][options]" id="options-hidden-{{ $index }}">
                                    </div>
                                    
                                    <div>
                                        <label class="lms-form-label">Correct Answer</label>
                                        <input type="text" name="questions[{{ $index }}][correct_answer]" value="{{ $question->correct_answer }}" required class="lms-form-input" id="correct-answer-{{ $index }}" placeholder="{{ $question->type == 'true_false' ? 'Enter: true or false' : 'Enter the letter of the correct answer' }}">
                                        <p class="mt-1 text-xs text-gray-500">For multiple choice: enter the letter (A, B, C, D). For true/false: enter "true" or "false"</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="flex gap-3">
                    <button type="submit" class="lms-btn-primary">Save Changes</button>
                    <a href="{{ route('admin.courses.edit', $quiz->course) }}" class="lms-btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        let questionCount = {{ $quiz->questions->count() }};

        function addQuestion() {
            const container = document.getElementById('questions-container');
            const questionId = questionCount;
            
            const questionHtml = `
                <div class="lms-card p-6" data-question="${questionId}">
                    <div class="flex justify-between items-start mb-4">
                        <h4 class="font-medium text-gray-900">Question ${questionCount + 1}</h4>
                        <button type="button" onclick="removeQuestion(this)" class="text-red-600 text-sm font-medium hover:text-red-800">
                            Remove
                        </button>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="lms-form-label">Question Text</label>
                            <textarea name="questions[${questionId}][question]" required class="lms-form-input" rows="3" placeholder="Enter your question here"></textarea>
                        </div>
                        
                        <div>
                            <label class="lms-form-label">Question Type</label>
                            <select name="questions[${questionId}][type]" required class="lms-form-input" onchange="toggleOptionsField(this, ${questionId})">
                                <option value="mcq">Multiple Choice</option>
                                <option value="true_false">True/False</option>
                            </select>
                        </div>
                        
                        <div id="options-container-${questionId}" class="options-section">
                            <label class="lms-form-label">Answer Options</label>
                            <div class="space-y-2" id="options-list-${questionId}">
                                <div class="flex gap-2">
                                    <input type="text" placeholder="Option A" class="lms-form-input flex-1 option-input" data-key="A">
                                    <button type="button" onclick="removeOption(this)" class="px-3 py-2 text-red-600 hover:bg-red-50 rounded">✕</button>
                                </div>
                                <div class="flex gap-2">
                                    <input type="text" placeholder="Option B" class="lms-form-input flex-1 option-input" data-key="B">
                                    <button type="button" onclick="removeOption(this)" class="px-3 py-2 text-red-600 hover:bg-red-50 rounded">✕</button>
                                </div>
                                <div class="flex gap-2">
                                    <input type="text" placeholder="Option C" class="lms-form-input flex-1 option-input" data-key="C">
                                    <button type="button" onclick="removeOption(this)" class="px-3 py-2 text-red-600 hover:bg-red-50 rounded">✕</button>
                                </div>
                                <div class="flex gap-2">
                                    <input type="text" placeholder="Option D" class="lms-form-input flex-1 option-input" data-key="D">
                                    <button type="button" onclick="removeOption(this)" class="px-3 py-2 text-red-600 hover:bg-red-50 rounded">✕</button>
                                </div>
                            </div>
                            <button type="button" onclick="addOption(${questionId})" class="mt-2 text-sm text-blue-600 font-medium hover:text-blue-800">
                                + Add Another Option
                            </button>
                            <input type="hidden" name="questions[${questionId}][options]" id="options-hidden-${questionId}">
                        </div>
                        
                        <div>
                            <label class="lms-form-label">Correct Answer</label>
                            <input type="text" name="questions[${questionId}][correct_answer]" required class="lms-form-input" placeholder="Enter: A, B, C, D (for MCQ) or true/false" id="correct-answer-${questionId}">
                            <p class="mt-1 text-xs text-gray-500">For multiple choice: enter the letter (A, B, C, D). For true/false: enter "true" or "false"</p>
                        </div>
                    </div>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', questionHtml);
            questionCount++;
        }

        function removeQuestion(button) {
            if (confirm('Remove this question?')) {
                button.closest('.lms-card').remove();
            }
        }

        function toggleOptionsField(select, questionId) {
            const optionsContainer = document.getElementById('options-container-' + questionId);
            const correctAnswerInput = document.getElementById('correct-answer-' + questionId);
            
            if (select.value === 'true_false') {
                optionsContainer.style.display = 'none';
                correctAnswerInput.placeholder = 'Enter: true or false';
            } else {
                optionsContainer.style.display = 'block';
                correctAnswerInput.placeholder = 'Enter the letter of the correct answer (A, B, C, D)';
            }
        }

        function addOption(questionId) {
            const optionsList = document.getElementById('options-list-' + questionId);
            const currentOptions = optionsList.querySelectorAll('.option-input').length;
            const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            
            if (currentOptions >= 26) {
                alert('Maximum number of options reached');
                return;
            }
            
            const nextLetter = letters[currentOptions];
            const optionHtml = `
                <div class="flex gap-2">
                    <input type="text" placeholder="Option ${nextLetter}" class="lms-form-input flex-1 option-input" data-key="${nextLetter}">
                    <button type="button" onclick="removeOption(this)" class="px-3 py-2 text-red-600 hover:bg-red-50 rounded">✕</button>
                </div>
            `;
            optionsList.insertAdjacentHTML('beforeend', optionHtml);
        }

        function removeOption(button) {
            const optionsList = button.closest('[id^="options-list-"]');
            const optionsCount = optionsList.querySelectorAll('.option-input').length;
            
            if (optionsCount <= 2) {
                alert('You must have at least 2 options');
                return;
            }
            
            button.closest('.flex').remove();
        }

        document.querySelector('form').addEventListener('submit', function(e) {
            const questions = document.querySelectorAll('[data-question]');
            
            questions.forEach(question => {
                const questionId = question.getAttribute('data-question');
                const typeSelect = question.querySelector('select[name*="[type]"]');
                
                if (typeSelect.value === 'mcq') {
                    const optionsInputs = question.querySelectorAll('.option-input');
                    const options = {};
                    
                    optionsInputs.forEach(input => {
                        const key = input.getAttribute('data-key');
                        const value = input.value.trim();
                        if (value) {
                            options[key] = value;
                        }
                    });
                    
                    const hiddenInput = document.getElementById('options-hidden-' + questionId);
                    hiddenInput.value = JSON.stringify(options);
                } else {
                    const hiddenInput = document.getElementById('options-hidden-' + questionId);
                    hiddenInput.value = JSON.stringify({"true": "True", "false": "False"});
                }
            });
        });
    </script>
</x-app-layout>