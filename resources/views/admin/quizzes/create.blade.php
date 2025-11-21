<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Create Quiz for {{ $course->title }}</h2>
          
            <form method="POST" action="{{ route('admin.quizzes.store', $course) }}" class="lms-card p-8">
                @csrf
              
                <div class="mb-6">
                    <label class="lms-form-label">Quiz Title</label>
                    <input type="text" name="title" required class="lms-form-input">
                </div>
                <div class="mb-8">
                    <label class="lms-form-label">Pass Score (%)</label>
                    <input type="number" name="pass_score" value="70" min="0" max="100" required class="lms-form-input">
                </div>
                <div id="questions-container" class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Questions</h3>
                    <div class="question-item border border-gray-200 p-6 rounded-lg mb-6">
                        <div class="mb-4">
                            <label class="lms-form-label">Question</label>
                            <textarea name="questions[0][question]" required class="lms-form-input" rows="2"></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="lms-form-label">Type</label>
                            <select name="questions[0][type]" required class="lms-form-input question-type">
                                <option value="mcq">Multiple Choice</option>
                                <option value="true_false">True/False</option>
                            </select>
                        </div>
                        <div class="mb-4 mcq-options">
                            <label class="lms-form-label">Options (JSON format)</label>
                            <textarea name="questions[0][options]" required class="lms-form-input" rows="3" placeholder='{"A": "Option 1", "B": "Option 2", "C": "Option 3", "D": "Option 4"}'></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="lms-form-label">Correct Answer</label>
                            <input type="text" name="questions[0][correct_answer]" required class="lms-form-input" placeholder="A or true/false">
                        </div>
                    </div>
                </div>
                <button type="button" onclick="addQuestion()" class="lms-btn-secondary mb-6">Add Another Question</button>
              
                <button type="submit" class="lms-btn-primary">Create Quiz</button>
            </form>
        </div>
    </div>
    <script>
        let questionCount = 1;
      
        function addQuestion() {
            const container = document.getElementById('questions-container');
            const newQuestion = `
                <div class="question-item border border-gray-200 p-6 rounded-lg mb-6">
                    <div class="mb-4">
                        <label class="lms-form-label">Question</label>
                        <textarea name="questions[${questionCount}][question]" required class="lms-form-input" rows="2"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="lms-form-label">Type</label>
                        <select name="questions[${questionCount}][type]" required class="lms-form-input">
                            <option value="mcq">Multiple Choice</option>
                            <option value="true_false">True/False</option>
                        </select>
                    </div>
                    <div class="mb-4 mcq-options">
                        <label class="lms-form-label">Options (JSON format)</label>
                        <textarea name="questions[${questionCount}][options]" required class="lms-form-input" rows="3" placeholder='{"A": "Option 1", "B": "Option 2", "C": "Option 3", "D": "Option 4"}'></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="lms-form-label">Correct Answer</label>
                        <input type="text" name="questions[${questionCount}][correct_answer]" required class="lms-form-input" placeholder="A or true/false">
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-red-600 text-sm hover:underline">Remove Question</button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newQuestion);
            questionCount++;
        }
    </script>
</x-app-layout>