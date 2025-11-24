<x-app-layout>
    <div class="py-12 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-semibold text-gray-900 mb-2">Edit Course</h1>
                <p class="text-gray-600">Update course details and manage content</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <form method="POST" action="{{ route('admin.courses.update', $course) }}" enctype="multipart/form-data" class="lms-card p-8">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-6">
                            <div>
                                <label class="lms-form-label">Course Title</label>
                                <input type="text" name="title" value="{{ $course->title }}" required class="lms-form-input">
                            </div>
                            
                            <div>
                                <label class="lms-form-label">Description</label>
                                <textarea name="description" rows="5" class="lms-form-input">{{ $course->description }}</textarea>
                            </div>
                            
                            <div>
                                <label class="lms-form-label">Course Image</label>
                                @if($course->image)
                                    <img src="{{ Storage::url($course->image) }}" class="w-full h-48 object-cover rounded-lg mb-4">
                                @endif
                                <input type="file" name="image" accept="image/*" class="lms-form-input">
                            </div>
                            
                            <div class="flex items-center">
                                <input type="checkbox" name="is_published" value="1" {{ $course->is_published ? 'checked' : '' }} id="is_published" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="is_published" class="ml-3 text-sm font-medium text-gray-700">Publish course</label>
                            </div>
                        </div>
                        
                        <div class="mt-8 flex justify-between">
                            <button type="submit" class="lms-btn-primary">Save Changes</button>
                            <button type="button" onclick="if(confirm('Are you sure you want to delete this course?')) document.getElementById('delete-course-form').submit()" class="lms-btn-danger">
                                Delete Course
                            </button>
                        </div>
                    </form>
                    <form id="delete-course-form" method="POST" action="{{ route('admin.courses.destroy', $course) }}" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                
                <div class="lg:col-span-1 space-y-6">
                    <div class="lms-card p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-semibold text-gray-900">Lessons</h3>
                            <a href="{{ route('admin.lessons.create', $course) }}" class="text-blue-600 font-medium text-sm">+ Add</a>
                        </div>
                        
                        @if($course->lessons->count() > 0)
                            <div class="space-y-3">
                                @foreach($course->lessons as $lesson)
                                    <div class="border border-gray-200 rounded-lg p-3">
                                        <div class="flex justify-between items-start mb-2">
                                            <div class="font-medium text-gray-900 text-sm">{{ $lesson->title }}</div>
                                            <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">{{ ucfirst($lesson->type) }}</span>
                                        </div>
                                        <div class="flex gap-3 text-xs">
                                            <a href="{{ route('admin.lessons.edit', $lesson) }}" class="text-blue-600 font-medium">Edit</a>
                                            <button type="button" onclick="if(confirm('Delete this lesson?')) document.getElementById('delete-lesson-{{ $lesson->id }}').submit()" class="text-red-600 font-medium">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                    <form id="delete-lesson-{{ $lesson->id }}" method="POST" action="{{ route('admin.lessons.destroy', $lesson) }}" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-500 text-center py-4">No lessons yet</p>
                        @endif
                    </div>
                    
                    <div class="lms-card p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-semibold text-gray-900">Quizzes</h3>
                            <a href="{{ route('admin.quizzes.create', $course) }}" class="text-blue-600 font-medium text-sm">+ Add</a>
                        </div>
                        
                        @if($course->quizzes->count() > 0)
                            <div class="space-y-3">
                                @foreach($course->quizzes as $quiz)
                                    <div class="border border-gray-200 rounded-lg p-3">
                                        <div class="font-medium text-gray-900 text-sm mb-1">{{ $quiz->title }}</div>
                                        <div class="text-xs text-gray-500 mb-2">{{ $quiz->questions->count() }} questions</div>
                                        <div class="flex gap-3 text-xs">
                                            <a href="{{ route('admin.quizzes.edit', $quiz) }}" class="text-blue-600 font-medium">Edit</a>
                                            <button type="button" onclick="if(confirm('Delete this quiz?')) document.getElementById('delete-quiz-{{ $quiz->id }}').submit()" class="text-red-600 font-medium">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                    <form id="delete-quiz-{{ $quiz->id }}" method="POST" action="{{ route('admin.quizzes.destroy', $quiz) }}" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-500 text-center py-4">No quizzes yet</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>