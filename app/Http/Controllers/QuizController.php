<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function show(Quiz $quiz)
    {
        $quiz->load('questions');
        return view('quizzes.show', compact('quiz'));
    }

    public function submit(Request $request, Quiz $quiz)
    {
        $answers = $request->input('answers', []);
        $score = 0;
        $totalQuestions = $quiz->questions->count();

        foreach ($quiz->questions as $question) {
            $userAnswer = $answers[$question->id] ?? null;
            if ($userAnswer === $question->correct_answer) {
                $score++;
            }
        }

        $scorePercent = ($score / $totalQuestions) * 100;
        $passed = $scorePercent >= $quiz->pass_score;

        QuizAttempt::create([
            'user_id' => auth()->id(),
            'quiz_id' => $quiz->id,
            'answers' => $answers,
            'score' => $scorePercent,
            'passed' => $passed
        ]);

        return redirect()->route('courses.show', $quiz->course_id)
            ->with('success', "Quiz completed! Score: {$scorePercent}%. " . ($passed ? 'Passed!' : 'Failed.'));
    }

    public function create(Course $course)
    {
        return view('admin.quizzes.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'pass_score' => 'required|integer|min:0|max:100',
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'required',
            'questions.*.type' => 'required|in:mcq,true_false',
            'questions.*.options' => 'required',
            'questions.*.correct_answer' => 'required'
        ]);

        $quiz = Quiz::create([
            'course_id' => $course->id,
            'title' => $validated['title'],
            'pass_score' => $validated['pass_score']
        ]);

        foreach ($validated['questions'] as $q) {
            if (is_string($q['options'])) {
                $q['options'] = json_decode($q['options'], true);
            }
            
            $quiz->questions()->create($q);
        }

        return redirect()->route('admin.courses.edit', $course)->with('success', 'Quiz created successfully');
    }

    public function edit(Quiz $quiz)
    {
        $quiz->load('questions');
        return view('admin.quizzes.edit', compact('quiz'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'pass_score' => 'required|integer|min:0|max:100',
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'required',
            'questions.*.type' => 'required|in:mcq,true_false',
            'questions.*.options' => 'required',
            'questions.*.correct_answer' => 'required'
        ]);

        $quiz->update([
            'title' => $validated['title'],
            'pass_score' => $validated['pass_score']
        ]);

        $quiz->questions()->delete();
        
        foreach ($validated['questions'] as $q) {
            if (is_string($q['options'])) {
                $q['options'] = json_decode($q['options'], true);
            }
            
            $quiz->questions()->create($q);
        }

        return redirect()->route('admin.courses.edit', $quiz->course)->with('success', 'Quiz updated successfully');
    }

    public function destroy(Quiz $quiz)
    {
        $course = $quiz->course;
        $quiz->delete();
        return redirect()->route('admin.courses.edit', $course)->with('success', 'Quiz deleted successfully');
    }
}
