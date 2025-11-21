<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Edit Lesson</h2>
          
            <form method="POST" action="{{ route('admin.lessons.update', $lesson) }}" enctype="multipart/form-data" class="lms-card p-8">
                @csrf
                @method('PUT')
              
                <div class="mb-6">
                    <label class="lms-form-label">Title</label>
                    <input type="text" name="title" value="{{ $lesson->title }}" required class="lms-form-input">
                </div>
                <div class="mb-6">
                    <label class="lms-form-label">Type</label>
                    <select name="type" required class="lms-form-input">
                        <option value="text" {{ $lesson->type == 'text' ? 'selected' : '' }}>Text</option>
                        <option value="image" {{ $lesson->type == 'image' ? 'selected' : '' }}>Image</option>
                        <option value="pdf" {{ $lesson->type == 'pdf' ? 'selected' : '' }}>PDF</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label class="lms-form-label">Content</label>
                    <textarea name="content" rows="6" class="lms-form-input">{{ $lesson->content }}</textarea>
                </div>
                <div class="mb-6">
                    <label class="lms-form-label">File</label>
                    @if($lesson->file_path)
                        <p class="text-sm text-gray-600 mb-3">Current: {{ basename($lesson->file_path) }}</p>
                    @endif
                    <input type="file" name="file" class="lms-form-input">
                </div>
                <div class="mb-8">
                    <label class="lms-form-label">Order</label>
                    <input type="number" name="order" value="{{ $lesson->order }}" required class="lms-form-input">
                </div>
                <button type="submit" class="lms-btn-primary">Update Lesson</button>
            </form>
        </div>
    </div>
</x-app-layout>