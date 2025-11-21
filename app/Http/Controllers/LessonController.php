<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonCompletion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    public function create(Course $course)
    {
        return view('admin.lessons.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'nullable',
            'type' => 'required|in:text,image,pdf',
            'file' => 'nullable|file|max:10240',
            'order' => 'required|integer|min:0'
        ]);

        if ($request->hasFile('file')) {
            $validated['file_path'] = $request->file('file')->store('lessons', 'public');
        }

        $validated['course_id'] = $course->id;
        Lesson::create($validated);

        return redirect()->route('admin.courses.edit', $course)->with('success', 'Lesson added successfully');
    }

    public function edit(Lesson $lesson)
    {
        return view('admin.lessons.edit', compact('lesson'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'nullable',
            'type' => 'required|in:text,image,pdf',
            'file' => 'nullable|file|max:10240',
            'order' => 'required|integer|min:0'
        ]);

        if ($request->hasFile('file')) {
            if ($lesson->file_path) {
                Storage::disk('public')->delete($lesson->file_path);
            }
            $validated['file_path'] = $request->file('file')->store('lessons', 'public');
        }

        $lesson->update($validated);

        return redirect()->route('admin.courses.edit', $lesson->course)->with('success', 'Lesson updated successfully');
    }

    public function destroy(Lesson $lesson)
    {
        $course = $lesson->course;
        if ($lesson->file_path) {
            Storage::disk('public')->delete($lesson->file_path);
        }
        $lesson->delete();

        return redirect()->route('admin.courses.edit', $course)->with('success', 'Lesson deleted successfully');
    }

    public function complete(Lesson $lesson)
    {
        LessonCompletion::firstOrCreate([
            'user_id' => auth()->id(),
            'lesson_id' => $lesson->id
        ]);

        return back()->with('success', 'Lesson marked as complete');
    }
}
