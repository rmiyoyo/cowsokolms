<x-app-layout>
    <div class="py-12 bg-white">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-semibold text-gray-900 mb-2">Edit Lesson</h1>
                <p class="text-gray-600">Update lesson content and settings</p>
            </div>
            
            <form method="POST" action="{{ route('admin.lessons.update', $lesson) }}" enctype="multipart/form-data" class="lms-card p-8">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    <div>
                        <label class="lms-form-label">Lesson Title</label>
                        <input type="text" name="title" value="{{ $lesson->title }}" required class="lms-form-input">
                    </div>
                    
                    <div>
                        <label class="lms-form-label">Lesson Type</label>
                        <select name="type" required class="lms-form-input">
                            <option value="text" {{ $lesson->type == 'text' ? 'selected' : '' }}>Text Content</option>
                            <option value="image" {{ $lesson->type == 'image' ? 'selected' : '' }}>Image</option>
                            <option value="pdf" {{ $lesson->type == 'pdf' ? 'selected' : '' }}>PDF Document</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="lms-form-label">Content</label>
                        <textarea name="content" rows="8" class="lms-form-input">{{ $lesson->content }}</textarea>
                    </div>
                    
                    <div>
                        <label class="lms-form-label">File Upload</label>
                        @if($lesson->file_path)
                            <div class="mb-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                                <p class="text-sm text-gray-700">Current file: <span class="font-medium">{{ basename($lesson->file_path) }}</span></p>
                            </div>
                        @endif
                        <input type="file" name="file" class="lms-form-input">
                        <p class="mt-2 text-sm text-gray-500">Upload a new file to replace the current one</p>
                    </div>
                    
                    <div>
                        <label class="lms-form-label">Display Order</label>
                        <input type="number" name="order" value="{{ $lesson->order }}" required class="lms-form-input">
                    </div>
                </div>
                
                <div class="mt-8 flex gap-3">
                    <button type="submit" class="lms-btn-primary">Save Changes</button>
                    <a href="{{ route('admin.courses.edit', $lesson->course) }}" class="lms-btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>