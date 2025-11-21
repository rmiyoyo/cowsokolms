<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->isAdmin() || $user->isInstructor()) {
            $courses = Course::where('instructor_id', $user->id)->with('enrollments')->get();
            return view('dashboard.instructor', compact('courses'));
        }
        
        $enrolledCourses = $user->enrolledCourses()->with('lessons')->get();
        $availableCourses = Course::where('is_published', true)
            ->whereNotIn('id', $enrolledCourses->pluck('id'))
            ->get();
        
        return view('dashboard.student', compact('enrolledCourses', 'availableCourses'));
    }
}
