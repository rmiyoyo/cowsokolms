<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['instructor_id', 'title', 'description', 'image', 'is_published'];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('order');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function getProgressForUser($userId)
    {
        $totalLessons = $this->lessons()->count();
        if ($totalLessons === 0) return 0;
        
        $completedLessons = LessonCompletion::whereIn('lesson_id', $this->lessons->pluck('id'))
            ->where('user_id', $userId)
            ->count();
        
        return round(($completedLessons / $totalLessons) * 100);
    }
}