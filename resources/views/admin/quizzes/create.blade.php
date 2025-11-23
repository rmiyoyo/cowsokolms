<x-app-layout>
    <div class="py-12 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-semibold text-gray-900 mb-2">Create Quiz</h1>
                <p class="text-gray-600">Create a quiz for {{ $course->title }}</p>
            </div>
            
            <form method="POST" action="{{ route('admin.quizzes.store', $course) }}" class="space-y-6">
                @csrf
                
                <div class="lms-card p-8">
                    <div class="space-y-6">
                        <div>
                            <label class="lms-form-label">Quiz Title</label>
                            <input type="text" name="title" required class="lms-form-input" placeholder="Module 1 Assessment">
                        </div>
                        
                        <div>
                            <label class="lms-form-label">Pass Score (%)</label>
                            <input type="number" name="pass_score" value="70" min="0" max="100" required class="lms-form-input">
                            <p class="mt-2 text-sm text-gray-500">Minimum score required to pass</p>
                        </div>
                    </div>
                </div>
                
                <div>
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-semibold text-gray-900">Questions</h3>
                        <button type="button" onclick="addQuestion()" class="lms-btn-secondary text-sm">+ Add Question</button>
                    </div>
                    
                    <div id="questions-container" class="space-y-6">
                        <div class="lms-card p-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="lms-form-label">Question</label>
                                    <textarea name="questions[0][question]" required class="lms-form-input" rows="3" placeholder="Enter your question here"></textarea>
                                </div>
                                
                                <div>
                                    <label class="lms-form-label">Type</label>
                                    <select name="questions[0][type]" required class="lms-form-input">
                                        <option value="mcq">Multiple Choice</option>
                                        <option value="true_false">True/False</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="lms-form-label">Options (JSON format)</label>
                                    <textarea name="questions[0][options]" required class="lms-form-input" rows="4" placeholder='{"A": "Option 1", "B": "Option 2", "C": "Option 3", "D": "Option 4"}'></textarea>
                                    <p class="mt-2 text-sm text-gray-500">For multiple choice questions only</p>
                                </div>
                                
                                <div>
                                    <label class="lms-form-label">Correct Answer</label>
                                    <input type="text" name="questions[0][correct_answer]" required class="lms-form-input" placeholder="A or true/false">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex gap-3">
                    <button type="submit" class="lms-btn-primary">Create Quiz</button>
                    <a href="{{ route('admin.courses.edit', $course) }}" class="lms-btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        let questionCount = 1;
        
        function addQuestion() {
            const container = document.getElementById('questions-container');
            const newQuestion = `
                <div class="lms-card p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h4 class="font-medium text-gray-900">Question ${questionCount + 1}</h4>
                        <button type="button" onclick="this.closest('.lms-card').remove()" class="text-red-600 text-sm font-medium">Remove</button>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="lms-form-label">Question</label>
                            <textarea name="questions[${questionCount}][question]" required class="lms-form-input" rows="3"></textarea>
                        </div>
                        <div>
                            <label class="lms-form-label">Type</label>
                            <select name="questions[${questionCount}][type]" required class="lms-form-input">
                                <option value="mcq">Multiple Choice</option>
                                <option value="true_false">True/False</option>
                            </select>
                        </div>
                        <div>
                            <label class="lms-form-label">Options (JSON format)</label>
                            <textarea name="questions[${questionCount}][options]" required class="lms-form-input" rows="4" placeholder='{"A": "Option 1", "B": "Option 2", "C": "Option 3", "D": "Option 4"}'></textarea>
                        </div>
                        <div>
                            <label class="lms-form-label">Correct Answer</label>
                            <input type="text" name="questions[${questionCount}][correct_answer]" required class="lms-form-input" placeholder="A or true/false">
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newQuestion);
            questionCount++;
        }
    </script>
</x-app-layout>