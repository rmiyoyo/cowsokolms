<x-app-layout>
    <div class="py-12 bg-white">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-semibold text-gray-900 mb-2">Create Course</h1>
                <p class="text-gray-600">Add a new course to your catalog</p>
            </div>
            
            <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data" class="lms-card p-8">
                @csrf
                
                <div class="space-y-6">
                    <div>
                        <label class="lms-form-label">Course Title</label>
                        <input type="text" name="title" required class="lms-form-input" placeholder="Introduction to Web Development">
                    </div>
                    
                    <div>
                        <label class="lms-form-label">Description</label>
                        <textarea name="description" rows="5" class="lms-form-input" placeholder="Describe what students will learn in this course..."></textarea>
                    </div>
                    
                    <div>
                        <label class="lms-form-label">Course Image</label>
                        <input type="file" name="image" accept="image/*" class="lms-form-input">
                        <p class="mt-2 text-sm text-gray-500">Recommended size: 1200x600 pixels</p>
                    </div>
                    
                    <div class="flex items-center">
                        <input type="checkbox" name="is_published" value="1" id="is_published" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_published" class="ml-3 text-sm font-medium text-gray-700">Publish course immediately</label>
                    </div>
                </div>
                
                <div class="mt-8 flex gap-3">
                    <button type="submit" class="lms-btn-primary">Create Course</button>
                    <a href="{{ route('admin.index') }}" class="lms-btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>