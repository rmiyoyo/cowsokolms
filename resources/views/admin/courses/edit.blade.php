<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Edit Course</h2>
          
            <form method="POST" action="{{ route('admin.courses.update', $course) }}" enctype="multipart/form-data" class="lms-card p-8 mb-8">
                @csrf
                @method('PUT')
              
                <div class="mb-6">
                    <label class="lms-form-label">Title</label>
                    <input type="text" name="title" value="{{ $course->title }}" required class="lms-form-input">
                </div>
                <div class="mb-6">
                    <label class="lms-form-label">Description</label>
                    <textarea name="description" rows="4" class="lms-form-input">{{ $course->description }}</textarea>
                </div>
                <div class="mb-6">
                    <label class="lms-form-label">Course Image</label>
                    @if($course->image)
                        <img src="{{ Storage::url($course->image) }}" class="w-32 h-32 object-cover rounded-lg mb-3">
                    @endif
                    <input type="file" name="image" accept="image/*" class="lms-form-input">
                </div>
                <div class="mb-8">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_published" value="1" {{ $course->is_published ? 'checked' : '' }} class="mr-2 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <span class="text-sm font-medium text-gray-700">Publish Course</span>
                    </label>
                </div>
                <div class="flex justify-between">
                    <button type="submit" class="lms-btn-primary">Update Course</button>
                    <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" onsubmit="return confirm('Delete this course?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="lms-btn-danger">Delete</button>
                    </form>
                </div>
            </form>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="lms-card p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Lessons</h3>
                        <a href="{{ route('admin.lessons.create', $course) }}" class="lms-btn-secondary">Add Lesson</a>
                    </div>
                    @foreach($course->lessons as $lesson)
                        <div class="border-b border-gray-200 pb-4 mb-4 last:border-b-0 last:mb-0 flex justify-between items-center">
                            <div>
                                <span class="font-bold text-gray-900">{{ $lesson->title }}</span>
                                <span class="text-xs text-gray-500 ml-2">{{ ucfirst($lesson->type) }}</span>
                            </div>
                            <div class="flex gap-3">
                                <a href="{{ route('admin.lessons.edit', $lesson) }}" class="text-blue-600 hover:underline text-sm">Edit</a>
                                <form method="POST" action="{{ route('admin.lessons.destroy', $lesson) }}" onsubmit="return confirm('Delete?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="lms-card p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Quizzes</h3>
                        <a href="{{ route('admin.quizzes.create', $course) }}" class="lms-btn-secondary">Add Quiz</a>
                    </div>
                    @foreach($course->quizzes as $quiz)
                        <div class="border-b border-gray-200 pb-4 mb-4 last:border-b-0 last:mb-0 flex justify-between items-center">
                            <div>
                                <span class="font-bold text-gray-900">{{ $quiz->title }}</span>
                                <span class="text-xs text-gray-500 ml-2">{{ $quiz->questions->count() }} questions</span>
                            </div>
                            <div class="flex gap-3">
                                <a href="{{ route('admin.quizzes.edit', $quiz) }}" class="text-blue-600 hover:underline text-sm">Edit</a>
                                <form method="POST" action="{{ route('admin.quizzes.destroy', $quiz) }}" onsubmit="return confirm('Delete?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>