<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('is_published', true)->with('instructor')->get();
        return view('courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        $course->load(['lessons', 'quizzes']);
        $enrolled = auth()->user()->enrolledCourses->contains($course->id);
        $progress = $enrolled ? $course->getProgressForUser(auth()->id()) : 0;
        
        return view('courses.show', compact('course', 'enrolled', 'progress'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'image' => 'nullable|image|max:2048',
            'is_published' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('courses', 'public');
        }

        $validated['instructor_id'] = auth()->id();
        Course::create($validated);

        return redirect()->route('admin.index')->with('success', 'Course created successfully');
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'image' => 'nullable|image|max:2048',
            'is_published' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            $validated['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($validated);

        return redirect()->route('admin.index')->with('success', 'Course updated successfully');
    }

    public function destroy(Course $course)
    {
        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }
        $course->delete();

        return redirect()->route('admin.index')->with('success', 'Course deleted successfully');
    }

    public function enroll(Course $course)
    {
        auth()->user()->enrolledCourses()->attach($course->id);
        return redirect()->route('courses.show', $course)->with('success', 'Enrolled successfully');
    }
}
