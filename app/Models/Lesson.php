<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = ['course_id', 'title', 'content', 'type', 'file_path', 'order'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function completions()
    {
        return $this->hasMany(LessonCompletion::class);
    }

    public function isCompletedBy($userId)
    {
        return $this->completions()->where('user_id', $userId)->exists();
    }
}