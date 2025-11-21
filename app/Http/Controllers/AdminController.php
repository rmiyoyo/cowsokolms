<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function index()
    {
        $courses = auth()->user()->courses()->with('lessons', 'enrollments')->get();
        return view('admin.index', compact('courses'));
    }
}
