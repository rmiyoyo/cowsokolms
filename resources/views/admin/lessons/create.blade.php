<x-app-layout>
    <div class="py-12 bg-white">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-semibold text-gray-900 mb-2">Add Lesson</h1>
                <p class="text-gray-600">Add a new lesson to {{ $course->title }}</p>
            </div>
            
            <form method="POST" action="{{ route('admin.lessons.store', $course) }}" enctype="multipart/form-data" class="lms-card p-8">
                @csrf
                
                <div class="space-y-6">
                    <div>
                        <label class="lms-form-label">Lesson Title</label>
                        <input type="text" name="title" required class="lms-form-input" placeholder="Introduction to the Course">
                    </div>
                    
                    <div>
                        <label class="lms-form-label">Lesson Type</label>
                        <select name="type" required class="lms-form-input">
                            <option value="text">Text Content</option>
                            <option value="image">Image</option>
                            <option value="pdf">PDF Document</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="lms-form-label">Content</label>
                        <textarea name="content" rows="8" class="lms-form-input" placeholder="Enter the lesson content here..."></textarea>
                        <p class="mt-2 text-sm text-gray-500">Main text content for the lesson</p>
                    </div>
                    
                    <div>
                        <label class="lms-form-label">File Upload (for image/pdf lessons)</label>
                        <input type="file" name="file" class="lms-form-input">
                    </div>
                    
                    <div>
                        <label class="lms-form-label">Display Order</label>
                        <input type="number" name="order" value="0" required class="lms-form-input">
                        <p class="mt-2 text-sm text-gray-500">Lower numbers appear first</p>
                    </div>
                </div>
                
                <div class="mt-8 flex gap-3">
                    <button type="submit" class="lms-btn-primary">Add Lesson</button>
                    <a href="{{ route('admin.courses.edit', $course) }}" class="lms-btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>